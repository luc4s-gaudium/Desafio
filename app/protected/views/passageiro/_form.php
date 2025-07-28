<?php
/* @var $this PassageiroController */
/* @var $model Passageiro */
/* @var $form CActiveForm */
?>

<!-- form -->
<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'passageiro-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation' => false,
	));
	$classLabel = array('class' => 'd-block mb-2 fw-bold fs-6');
	$classInput = array('class' => 'form-control');
	$classError = array('class' => 'text-danger mt-1 fs-7');
	?>

	<!-- <?php echo $form->errorSummary($model); ?> -->

	<section>
		<div class="row">
			<div class="col-md-6 mb-4">
				<?php echo $form->labelEx($model, 'nome', $classLabel); ?>
				<?php echo $form->textField($model, 'nome', array_merge($classInput, ['placeholder' => 'Digite o seu nome completo com no mínimo 3 letras por nome'])); ?>
				<?php echo $form->error($model, 'nome', $classError); ?>
			</div>
			<div class="col-md-6 mb-4">
				<?php echo $form->labelEx($model, 'email', $classLabel); ?>
				<?php echo $form->emailField($model, 'email', array_merge($classInput, ['placeholder' => 'email@exemplo.com.br', 'type' => 'email'])); ?>
				<?php echo $form->error($model, 'email', $classError); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 mb-4">
				<?php echo $form->labelEx($model, 'nascimento', $classLabel); ?>
				<?php echo $form->dateField($model, 'nascimento', array_merge($classInput, ['placeholder' => 'AAAA-MM-DD', 'type' => 'date'])); ?>
				<?php echo $form->error($model, 'nascimento', $classError); ?>
			</div>
			<div class="col-md-4 mb-4">
				<?php echo $form->labelEx($model, 'telefone', $classLabel); ?>
				<?php echo $form->telField($model, 'telefone', array_merge($classInput, ['placeholder' => '+55-11-999999999'])); ?>
				<?php echo $form->error($model, 'telefone', $classError); ?>
			</div>
			<div class="col-md-4 mb-4">
				<?php echo $form->labelEx($model, 'status', $classLabel); ?>
				<?php echo $form->dropDownList($model, 'status', array('A' => 'Ativo', 'I' => 'Inativo'), array_merge(array_merge($classInput, ['prompt' => 'Selecione um status..).']))); ?>
				<?php echo $form->error($model, 'status', $classError); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mb-4">
				<?php echo $form->labelEx($model, 'Observações', $classLabel); ?>
				<?php echo $form->textArea($model, 'obs', array_merge(array_merge($classInput, ['placeholder' => 'Observações'], ['rows' => 4, 'style' => 'resize: none;']))); ?>
				<?php echo $form->error($model, 'obs', $classError); ?>

			</div>
		</div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', ['class' => 'btn btn-primary w-100']); ?>
			</div>
		</div>
	</section>


	<?php $this->endWidget(); ?>

</div>