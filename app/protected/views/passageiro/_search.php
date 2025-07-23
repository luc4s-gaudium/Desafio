<?php
/* @var $this PassageiroController */
/* @var $model Passageiro */
/* @var $form CActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
)); ?>
<div class="wide form mt-3">

	<section>
		<div class="row">
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'id'); ?>
				</p>
				<?php echo $form->textField($model, 'id', ['class' => 'form-control']); ?>
			</div>
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'nome'); ?>
				</p>
				<?php echo $form->textField($model, 'nome', ['class' => 'form-control'], array('maxlength' => 255)); ?>
			</div>
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'nascimento'); ?>
				</p>
				<?php echo $form->textField($model, 'nascimento', ['class' => 'form-control']); ?>
			</div>
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'email'); ?>
				</p>
				<?php echo $form->textField($model, 'email', ['class' => 'form-control'], array('maxlength' => 255)); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'telefone'); ?>
				</p>
				<?php echo $form->textField($model, 'telefone', ['class' => 'form-control'], array('maxlength' => 255)); ?>
			</div>
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'data_hora_status'); ?>
				</p>
				<?php echo $form->textField($model, 'data_hora_status', ['class' => 'form-control']); ?>
			</div>
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'status'); ?>
				</p>
				<?php echo $form->textField($model, 'status', ['class' => 'form-control'], array('maxlength' => 1)); ?>
			</div>
			<div class="col-md-3 mb-4">
				<p class="mb-2">
					<?php echo $form->label($model, 'obs'); ?>
				</p>
				<?php echo $form->textField($model, 'obs', ['class' => 'form-control'], array('maxlength' => 200)); ?>
			</div>
		</div>
	</section>


	<div class="row buttons mt-5">
		<?php echo CHtml::submitButton('Pesquisar', ['class' => 'btn btn-outline-secondary']); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->