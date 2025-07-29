<?php

class ApiController extends Controller
{
	/**
	 * Executado antes de qualquer action para validar o token da API.
	 */
	protected function beforeAction($action)
	{
		header('Content-Type: application/json; charset=utf-8');
		$caminhoToken = Yii::getPathOfAlias('application.config.secret') . '.txt';
		if (!file_exists($caminhoToken)) {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => ['Token de API não configurado no servidor.']));
		}
		$tokenEsperado = trim(file_get_contents($caminhoToken));
		$tokenEnviado = isset($_SERVER['HTTP_API_TOKEN']) ? $_SERVER['HTTP_API_TOKEN'] : null;

		if ($tokenEnviado !== $tokenEsperado) {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => ['Token de API inválido ou não fornecido.']));
		}
		return parent::beforeAction($action);
	}

	/**
	 * Action para solicitar uma nova corrida.
	 */
	public function actionSolicitar()
	{
		$json = file_get_contents('php://input');
		$dados = CJSON::decode($json);
		$erros = array();

		// 1. Validações do Passageiro e dos Locais
		$passageiro = $this->validarPassageiro($dados, $erros);
		$distanciaKm = $this->validarOrigemDestino($dados, $erros);

		if (!empty($erros)) {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => $erros));
		}

		// 2. Encontrar um Motorista disponível
		$motorista = $this->encontrarMotoristaDisponivel($erros);
		if (!$motorista) {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => $erros));
		}

		// 3. Calcular os dados da corrida
		$tempoViagemMinutos = ($distanciaKm * 1000) / 200; // 1 min a cada 200m
		$tempoTotalMinutos = $tempoViagemMinutos + 3; // Adiciona 3 min fixos
		$tarifa = 5.00 + ($distanciaKm * 2.00) + ($tempoViagemMinutos * 0.50);
		$tarifa = round($tarifa, 2); // Arredonda para 2 casas decimais

		if ($tempoViagemMinutos > 480) {
			$erros[] = "A duração da corrida não pode exceder 8 horas.";
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => $erros));
			return;
		}

		// 4. Criar e salvar a nova corrida
		$corrida = new Corrida;
		$corrida->passageiro_id = $passageiro->id;
		$corrida->motorista_id = $motorista->id;
		$corrida->endereco_origem = $dados['origem']['endereco'];
		$corrida->origem_lat = $dados['origem']['lat'];
		$corrida->origem_lng = $dados['origem']['lng'];
		$corrida->endereco_destino = $dados['destino']['endereco'];
		$corrida->destino_lat = $dados['destino']['lat'];
		$corrida->destino_lng = $dados['destino']['lng'];
		$corrida->data_hora_inicio = new CDbExpression('NOW()');
		$corrida->previsao_chegada_destino = new CDbExpression("NOW() + INTERVAL $tempoTotalMinutos MINUTE");
		$corrida->tarifa = $tarifa;
		$corrida->status = 'Em andamento';

		if (!$corrida->save()) {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => $corrida->getErrors()));
		}

		$corrida->refresh(); // Atualiza o objeto com os dados do banco (importante para pegar a data)

		// 5. Preparar e enviar a resposta de sucesso
		$resposta = array(
			'sucesso' => true,
			'corrida' => array(
				'id' => $corrida->id,
				'previsao_chegada_destino' => date('Y-m-d H:i', strtotime($corrida->previsao_chegada_destino)),
			),
			'motorista' => array(
				'nome' => $motorista->nome,
				'placa' => $motorista->placa_veiculo,
				'quantidade_corridas' => (int) Corrida::model()->countByAttributes(array('motorista_id' => $motorista->id)),
			),
		);

		$this->enviarResposta(200, $resposta);
	}

	/**
	 * Action para finalizar uma corrida.
	 */
	public function actionFinalizar()
	{
		$json = file_get_contents('php://input');
		$dados = CJSON::decode($json);
		$erros = array();

		if (!isset($dados['corrida']['id']) || !isset($dados['motorista']['id'])) {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => ['ID da corrida e do motorista são obrigatórios.']));
		}

		$corrida = Corrida::model()->findByPk($dados['corrida']['id']);

		if (!$corrida) {
			$erros[] = "Corrida não existe";
		} else {
			if ($corrida->status !== 'Em andamento') {
				$erros[] = "Corrida já finalizada ou não está em andamento";
			}
			if ($corrida->motorista_id != $dados['motorista']['id']) {
				$erros[] = "Motorista não corresponde à corrida";
			}
		}

		if (!empty($erros)) {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => $erros));
		}

		$corrida->status = 'Finalizada';
		$corrida->data_hora_finalizacao = new CDbExpression('NOW()');

		if ($corrida->save()) {
			$this->enviarResposta(200, array('sucesso' => true));
		} else {
			$this->enviarResposta(400, array('sucesso' => false, 'erros' => $corrida->getErrors()));
		}
	}

	// MÉTODOS AUXILIARES

	private function validarPassageiro($dados, &$erros)
	{
		if (!isset($dados['passageiro']['id'])) {
			$erros[] = "ID do passageiro não fornecido.";
			return null;
		}

		$passageiro = Passageiro::model()->findByPk($dados['passageiro']['id']);

		if (!$passageiro) {
			$erros[] = "Passageiro não encontrado.";
			return null;
		}
		if ($passageiro->status !== 'A') {
			$erros[] = "Passageiro não está ativo.";
		}
		if (Corrida::model()->exists('passageiro_id=:id AND status=:status', array(':id' => $passageiro->id, ':status' => 'Em andamento'))) {
			$erros[] = "Passageiro já possui uma corrida em andamento.";
		}
		return $passageiro;
	}

	private function validarOrigemDestino($dados, &$erros)
	{
		if (!isset($dados['origem']['endereco']) || !isset($dados['destino']['endereco'])) {
			$erros[] = "Endereço de origem e destino são obrigatórios.";
			return 0;
		}
		if ($dados['origem']['endereco'] == $dados['destino']['endereco']) {
			$erros[] = "Endereço de origem e destino não podem ser iguais.";
		}

		$distanciaMetros = $this->calcularDistancia($dados['origem']['lat'], $dados['origem']['lng'], $dados['destino']['lat'], $dados['destino']['lng']);
		if ($distanciaMetros <= 100) {
			$erros[] = "Origem e destino muito próximos (deve ser maior que 100 metros).";
		}
		return $distanciaMetros / 1000; // Retorna em KM
	}

	private function encontrarMotoristaDisponivel(&$erros)
	{
		// Critério: Motorista ativo que NÃO ESTÁ em uma corrida em andamento
		$criteria = new CDbCriteria;
		$criteria->addCondition("status = 'A'");
		$criteria->addCondition("id NOT IN (SELECT motorista_id FROM corrida WHERE status = 'Em andamento' AND motorista_id IS NOT NULL)");
		$criteria->order = 'RAND()'; // Pega um motorista aleatório que atenda aos critérios

		$motorista = Motorista::model()->find($criteria);

		if (!$motorista) {
			$erros[] = "Nenhum motorista disponível no momento.";
		}
		return $motorista;
	}

	private function calcularDistancia($lat1, $lon1, $lat2, $lon2)
	{
		$raioTerra = 6371000; // Raio da Terra em metros
		$dLat = deg2rad($lat2 - $lat1);
		$dLon = deg2rad($lon2 - $lon1);
		$a = sin($dLat / 2) * sin($dLat / 2) +
			cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
			sin($dLon / 2) * sin($dLon / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		return $raioTerra * $c;
	}

	private function enviarResposta($status, $corpo)
	{
		http_response_code($status);
		echo CJSON::encode($corpo);
		Yii::app()->end(); // Termina a execução da aplicação
	}
}
