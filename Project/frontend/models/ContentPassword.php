<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "content_password".
 *
 * @property int $id
 * @property int $user_id
 * @property int $templates
 * @property string $password
 * @property string $updated_at
 */
class ContentPassword extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_password';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'templates', 'password', 'updated_at'], 'required'],
            [['user_id', 'templates'], 'integer'],
            [['updated_at'], 'safe'],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'templates' => 'Templates',
            'password' => 'Password',
            'updated_at' => 'Updated At',
        ];
    }
}
