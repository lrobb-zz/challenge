<?php
$this->breadcrumbs=array(
	'Workouts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Workouts', 'url'=>array('index')),
	array('label'=>'Create Workouts', 'url'=>array('create')),
	array('label'=>'Update Workouts', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Workouts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Workouts', 'url'=>array('admin')),
);
?>

<h1>View Workouts #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'sport',
		'distance',
		'date',
		// 'description',
		array(
			'name'=>'description',
			'type'=>'raw',
			'value'=>'<pre>' . $model->description . '</pre>',
		),
	),
)); ?>
