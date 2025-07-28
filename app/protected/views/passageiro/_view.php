<?php
/* @var $this PassageiroController */
/* @var $data Passageiro */
?>

<div class="view">
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">
					<?php echo CHtml::encode($data->getAttributeLabel('id')); ?>
				</th>
				<th scope="col">
					<?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>
				</th>
				<th scope="col">
					<?php echo CHtml::encode($data->getAttributeLabel('nascimento')); ?>
				</th>
				<th scope="col">
					<?php echo CHtml::encode($data->getAttributeLabel('email')); ?>
				</th>
				<th scope="col">
					<?php echo CHtml::encode($data->getAttributeLabel('telefone')); ?>
				</th>
				<th scope="col">
					<?php echo CHtml::encode($data->getAttributeLabel('data_hora_status')); ?>
				</th>
				<th scope="col">
					<?php echo CHtml::encode($data->getAttributeLabel('status')); ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">
					<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
				</th>
				<td>
					<?php echo CHtml::encode($data->nome); ?>
				</td>
				<td>
					<?php echo CHtml::encode($data->nascimento); ?>
				</td>
				<td>
					<?php echo CHtml::encode($data->email); ?>
				</td>
				<td>
					<?php echo CHtml::encode($data->telefone); ?>
				</td>
				<td>
					<?php echo CHtml::encode($data->data_hora_status); ?>
				</td>
				<td> <?php echo CHtml::encode($data->status); ?>
				</td>
			</tr>
		</tbody>
	</table>

</div>