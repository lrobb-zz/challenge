<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'workouts-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'sport'); ?>
        <?php //echo $form->textField($model,'sport',array('size'=>25,'maxlength'=>25)); ?>

        <?php
        echo CHtml::activeDropDownList($model, 'sport', array('swim' => 'swim', 'bike' => 'bike', 'run' => 'run'), array('empty' => '(Select a sport)'));
        ?>			  

        <?php echo $form->error($model, 'sport'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'distance'); ?>
        <?php echo $form->textField($model, 'distance'); ?>
        <?php echo $form->error($model, 'distance'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php //echo $form->textField($model,'date'); ?>
        <?php $this->widget ('zii.widgets.jui.CJuiDatePicker', array (
			'model' => $model,
			'attribute' => 'date',
			'options' => array (
				'showAnim' => 'fold',
				'dateFormat' => 'm/d/yy',
			)));
		?>
        
    <?php echo $form->error($model, 'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
<?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->