<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "assigned_documents".
 *
 * @property int $id
 * @property int $assigned_to
 * @property int $document_id
 * @property string $comment
 * @property int $status
 *
 * @property Documents $document
 */
class AssignedDocuments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assigned_documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'document_id'], 'required'],
            [['assigned_to', 'document_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::className(), 'targetAttribute' => ['document_id' => 'id']],
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
            'comment' => 'Comment',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Documents::className(), ['id' => 'document_id']);
    }
}
