<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "document_password".
 *
 * @property int $id
 * @property int $user_id
 * @property int $document_id
 * @property string $password
 * @property string $updated_at
 */
class DocumentPassword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document_password';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'document_id', 'password', 'updated_at'], 'required'],
            [['user_id', 'document_id'], 'integer'],
            [['updated_at'], 'safe'],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'document_id' => 'Document ID',
            'password' => 'Password',
            'updated_at' => 'Updated At',
        ];
    }
}
