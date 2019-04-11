<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_cso_control_options".
 *
 * @property int $id
 * @property string $policy_option
 * @property int $score
 * @property string $created_at
 */
class MasterCsoControlOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_cso_control_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['policy_option', 'score'], 'required'],
            [['score'], 'integer'],
            [['created_at'], 'safe'],
            [['policy_option'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'policy_option' => 'Policy Option',
            'score' => 'Score',
            'created_at' => 'Created At',
        ];
    }
}
