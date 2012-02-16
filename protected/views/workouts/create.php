<?php
$this->breadcrumbs=array(
	'Workouts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Workouts', 'url'=>array('index')),
//	array('label'=>'Manage Workouts', 'url'=>array('admin')),
);
?>

<h1>Create Workouts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>