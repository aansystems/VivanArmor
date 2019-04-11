<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_how_to".
 *
 * @property int $id
 * @property string $title
 * @property string $icon_name
 * @property string $folder_name
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class MasterHowTo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_how_to';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'icon_name', 'folder_name', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['icon_name'], 'string', 'max' => 20],
            [['folder_name'], 'string', 'max' => 65],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'icon_name' => 'Icon Name',
            'folder_name' => 'Folder Name',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
