<?php

/**
 * This is the model class for table "points".
 *
 * The followings are the available columns in table 'points':
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property integer $swim_points
 * @property integer $bike_points
 * @property integer $run_points
 * @property integer $total_points
 */
class Points extends CActiveRecord
{

    public function addWorkout($workout)
    {

        $this->user_id = $workout->user_id;
        $this->username = Yii::app()->user->name;
        switch ($workout->sport)
        {
            case 'swim':
                $this->swim_points += $workout->distance / 100;
                break;
            case 'bike';
                $this->bike_points += $workout->distance;
                break;
            case 'run':
                $this->run_points += $workout->distance * 4;
                break;

        }
        $this->total_points = $this->swim_points + $this->bike_points + $this->run_points;

    }

    public function deleteWorkout($workout)
    {
        $this->user_id = $workout->user_id;
        $this->username = Yii::app()->user->name;
        switch ($workout->sport)
        {
            case 'swim':
                $this->swim_points -= $workout->distance / 100;
                break;
            case 'bike';
                $this->bike_points -= $workout->distance;
                break;
            case 'run':
                $this->run_points -= $workout->distance * 4;
                break;
        }
        
        $this->total_points = $this->swim_points + $this->bike_points + $this->run_points;
    }

    /**
     * Returns the static model of the specified AR class.
     * @return Points the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'points';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('user_id, username', 'required'),
//            array('user_id, swim_points, bike_points, run_points', 'numerical', 'integerOnly' => true),
//            // The following rule is used by search().
//            // Please remove those attributes that should not be searched.
//            array('id, user_id, username, swim_points, bike_points, run_points', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'username' => 'User Name',
            'swim_points' => 'Swim Points',
            'bike_points' => 'Bike Points',
            'run_points' => 'Run Points',
            'total_points' => 'Total Points',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('username', $this->username);
        $criteria->compare('swim_points', $this->swim_points);
        $criteria->compare('bike_points', $this->bike_points);
        $criteria->compare('run_points', $this->run_points);
        $criteria->compare('total_points', $this->total_points);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
					// 'sort' => array(
						
					// ),
                ));
    }

}