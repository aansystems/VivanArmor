<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_faq".
 *
 * @property int $id
 * @property string $question
 * @property string $description
 */
class MasterFaq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_faq';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'description'], 'required'],
            [['description'], 'string'],
            [['question'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'description' => 'Description',
        ];
    }
}
