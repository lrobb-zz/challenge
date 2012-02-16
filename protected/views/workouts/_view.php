<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sport')); ?>:</b>
	<?php echo CHtml::encode($data->sport); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distance')); ?>:</b>
	<?php echo CHtml::encode($data->distance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode(date('m-d-Y', $data->date)); ?>
	<br />
        
    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<pre><?php echo CHtml::encode($data->description); ?></pre>
	<br />


</div>