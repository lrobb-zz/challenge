<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=176602222365413";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php
$this->breadcrumbs = array(
    'Points',
);

$this->menu = array(
    array('label' => 'Enter Workout', 'url' => array('workouts/create')),
//    array('label' => 'Manage Points', 'url' => array('admin')),
);
?>

<h1>Points</h1>

<?php
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//));
?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'points-grid',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'username',
            'type' => 'raw',
            'value' => 'CHtml::Link("$data->username", "/challenge/index.php?r=workouts&user_id=$data->user_id");',
        ),
        'swim_points',
		'bike_points',
        'run_points',
        'total_points',
//        array(
//            'class' => 'CButtonColumn',
//        ),
    ),
));
?>
<center>
<div class="fb-comments" data-href="http://triokc.org/challenge/index.php?r=points" data-num-posts="20" data-width="600"></div>
</center>