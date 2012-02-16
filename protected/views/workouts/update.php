<?php
$this->breadcrumbs=array(
	'Workouts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Workouts', 'url'=>array('index')),
	array('label'=>'Create Workouts', 'url'=>array('create')),
	array('label'=>'View Workouts', 'url'=>array('view', 'id'=>$model->id)),
//	array('label'=>'Manage Workouts', 'url'=>array('admin')),
);
?>

<h1>Update Workouts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>