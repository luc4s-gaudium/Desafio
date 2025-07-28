<?php
/* @var $this PassageiroController */
/* @var $model Passageiro */

$this->breadcrumbs = array(
	'Passageiros' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'List Passageiro', 'url' => array('index')),
	array('label' => 'Create Passageiro', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#passageiro-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mb-2">
	<h1>Passageiros</h1>
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
	'id' => 'passageiro-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => 'table table-striped table-hover',
	'columns' => array(
		[
			'name' => 'id',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
			// 'filterHtmlOptions' => array('class' => 'bg-warning'),
		],
		[
			'name' => 'nome',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
			// 'filterHtmlOptions' => array('class' => 'bg-warning'),
		],
		[
			'name' => 'nascimento',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
			// 'filterHtmlOptions' => array('class' => 'bg-warning'),
		],
		[
			'name' => 'email',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
			// 'filterHtmlOptions' => array('class' => 'bg-warning'),
		],
		[
			'name' => 'telefone',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
			// 'filterHtmlOptions' => array('class' => 'bg-warning'),
		],
		[
			'name' => 'data_hora_status',
			'headerHtmlOptions' => ['class' => 'text-dark text-decoration-none'],
			// 'filterHtmlOptions' => array('class' => 'bg-warning'),
		],
		/*
		'status',
		'obs',
		*/
		array(
			'name' => 'status',
			'htmlOptions' => array('class' => 'text-dark text-decoration-none'),
			// 'filterHtmlOptions' => ['class' => 'bg-warning']
		),
		array(
			'class' => 'CButtonColumn',
			'htmlOptions' => array('class' => 'actions-cell'),

		),
	),
)); ?>
