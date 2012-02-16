<?php
$this->breadcrumbs=array(
	'Workouts',
);

$this->menu=array(
	array('label'=>'Create Workouts', 'url'=>array('create')),
//	array('label'=>'Manage Workouts', 'url'=>array('admin')),
);
?>

<h1>Workouts</h1> for <?php echo $fname . ' ' . $lname; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns' =>$columns,
	//'itemView'=>'_view',
        // 'columns'=>array(
			// 'sport',
			// 'distance',
			// 'date',
			// 'description',
			
			// array(
				// 'class'=>'CButtonColumn',
			// ),
			// // 'update' => array(
				// // 'name'=>'update',
				// // 'visible'=>'false',
				
			// // ),
		// ),
	)); ?>
