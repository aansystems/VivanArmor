<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "content_assign".
 *
 * @property int $id
 * @property int $content_id
 * @property int $view
 * @property int $download
 * @property string $security
 * @property string $expiry_date
 *
 * @property Contents $content
 */
class ContentAssign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_assign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'security', 'expiry_date','view','download'], 'required'],
            [['content_id', 'view', 'download'], 'integer'],
            [['expiry_date'], 'safe'],         
            [['content_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contents::className(), 'targetAttribute' => ['content_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id' => 'Content ID',
            'view' => 'View',
            'download' => 'Download',
            'security' => 'Security',
            'expiry_date' => 'Expiry Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(Contents::className(), ['id' => 'content_id']);
    }
}
