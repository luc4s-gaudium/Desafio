<?php
/* @var $this MotoristaController */
/* @var $model Motorista */

$this->breadcrumbs = array(
	'Motoristas' => array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#motorista-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-2">
	<h1>Motoristas</h1>
	<div>
		<button type="button" class="btn btn-primary">
			<?php echo CHtml::link('Pesquisa avançada', '#', array('class' => 'search-button text-white text-decoration-none')); ?>
		</button>
		<?php echo CHtml::link('+', array('create'), array('class' => 'btn btn-success')); ?>
	</div>
</div>
<!-- search-form -->
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search', array(
		'model' => $model,
	)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'motorista-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => 'table table-striped table-hover',
	'columns' => array(
		[
			'name' => 'id',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
		],
		[
			'name' => 'nome',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
		],
		[
			'name' => 'nascimento',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
		],
		[
			'name' => 'email',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
		],
		[
			'name' => 'telefone',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
		],
		[
			'name' => 'placa_veiculo',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
		],
		[
			'name' => 'data_hora_status',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
		],
		array(
			'name' => 'status',
			'htmlOptions' => array('class' => 'text-dark text-decoration-none'),
		),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array('class' => 'actions-cell'),

		),
	),
)); ?>