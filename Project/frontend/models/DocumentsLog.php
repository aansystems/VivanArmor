<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "documents_log".
 *
 * @property int $id
 * @property int $assigned_to
 * @property int $document_id
 * @property int $user_id
 * @property string $actions
 */
class DocumentsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assigned_to', 'document_id', 'user_id', 'actions'], 'required'],
            [['assigned_to', 'document_id', 'user_id'], 'integer'],
            [['actions'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assigned_to' => 'Assigned To',
            'document_id' => 'Document ID',
            'user_id' => 'User ID',
            'actions' => 'Actions',
        ];
    }
}
