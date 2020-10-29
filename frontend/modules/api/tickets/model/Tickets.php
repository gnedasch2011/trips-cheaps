<?php

namespace frontend\modules\api\tickets\model;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property string $name
 * @property string $actual
 * @property string $depart_date
 * @property string $destination
 * @property string $distance
 * @property string $duration
 * @property string $found_at
 * @property string $gate
 * @property string $number_of_changes
 * @property string $origin
 * @property string $return_date
 * @property string $show_to_affiliates
 * @property string $trip_class
 * @property string $value
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'actual', 'depart_date', 'destination', 'distance', 'duration', 'found_at', 'gate', 'number_of_changes', 'origin', 'return_date', 'show_to_affiliates', 'trip_class', 'value'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'actual' => 'Actual',
            'depart_date' => 'Depart Date',
            'destination' => 'Destination',
            'distance' => 'Distance',
            'duration' => 'Duration',
            'found_at' => 'Found At',
            'gate' => 'Gate',
            'number_of_changes' => 'Number Of Changes',
            'origin' => 'Origin',
            'return_date' => 'Return Date',
            'show_to_affiliates' => 'Show To Affiliates',
            'trip_class' => 'Trip Class',
            'value' => 'Value',
        ];
    }
}
