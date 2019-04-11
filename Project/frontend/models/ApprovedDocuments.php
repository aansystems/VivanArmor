<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "approved_documents".
 *
 * @property int $id
 * @property int $document_id
 * @property int $assigned_for_view
 * @property int $assigned_for_download
 * @property string $security
 * @property string $password
 * @property string $expiry_date
 * @property string $created_at
 * @property int $updated_at
 *
 * @property Documents $document
 */
class ApprovedDocuments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'approved_documents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id', 'security', 'expiry_date', 'created_at', 'updated_at'], 'required'],
            [['document_id', 'assigned_for_view', 'assigned_for_download', 'updated_at'], 'integer'],
            [['expiry_date', 'created_at'], 'safe'],
            [['security'], 'string', 'max' => 255],
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
            'document_id' => 'Document ID',
            'assigned_for_view' => 'Assigned For View',
            'assigned_for_download' => 'Assigned For Download',
            'security' => 'Security',
            'expiry_date' => 'Expiry Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
