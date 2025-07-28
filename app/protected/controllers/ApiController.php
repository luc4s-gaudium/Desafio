<?php

class ApiController extends Controller
{
    /**
     * Este método é executado antes de qualquer outra 'action' neste controller.
     * Usamos para verificar o token da API.
     */
    protected function beforeAction($action)
    {
        // 1. Define o tipo de resposta como JSON.
        header('Content-Type: application/json; charset=utf-8');

        // 2. Pega o token esperado do nosso arquivo secret.txt.
        $caminhoToken = Yii::getPathOfAlias('application.config.secret') . '.txt';
        if (!file_exists($caminhoToken)) {
            $this->enviarResposta(400, array('sucesso' => false, 'erros' => ['Token de API não configurado no servidor.']));
        }
        $tokenEsperado = trim(file_get_contents($caminhoToken));

        // 3. Pega o token enviado pelo cliente no cabeçalho (header).
        $tokenEnviado = isset($_SERVER['HTTP_API_TOKEN']) ? $_SERVER['HTTP_API_TOKEN'] : null;

        // 4. Compara os tokens. Se forem diferentes, retorna um erro.
        if ($tokenEnviado !== $tokenEsperado) {
            $this->enviarResposta(400, array('sucesso' => false, 'erros' => ['Token de API inválido ou não fornecido.']));
        }

        // Se o token estiver correto, permite que a action continue.
        return parent::beforeAction($action);
    }

    /**
     * Action para solicitar uma nova corrida.
     */
    public function actionSolicitar()
    {
        // A lógica da corrida virá aqui depois.
        $this->enviarResposta(200, array('sucesso' => true, 'mensagem' => 'Endpoint de solicitar corrida funcionando.'));
    }

    /**
     * Action para finalizar uma corrida.
     */
    public function actionFinalizar()
    {
        // A lógica da corrida virá aqui depois.
        $this->enviarResposta(200, array('sucesso' => true, 'mensagem' => 'Endpoint de finalizar corrida funcionando.'));
    }
    
    /**
     * Método auxiliar para enviar respostas JSON padronizadas.
     * @param int $status Código de status HTTP (ex: 200 para sucesso, 400 para erro)
     * @param array $corpo O conteúdo da resposta em formato de array
     */
    private function enviarResposta($status, $corpo)
    {
        http_response_code($status);
        echo CJSON::encode($corpo);
        Yii::app()->end(); // Termina a execução da aplicação
    }
}
