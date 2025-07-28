<?php
/* @var $this PassageiroController */
/* @var $model Passageiro */

$this->breadcrumbs = array(
	'Passageiros' => array('index'),
	'Create',
);

$this->menu = array(
	array('label' => 'List Passageiro', 'url' => array('index')),
	array('label' => 'Manage Passageiro', 'url' => array('admin')),
);
?>

<h1 class="mb-4 pb-3">Criar novo passageiro</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>