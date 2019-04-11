<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "contents".
 *
 * @property int $id
 * @property int $user_id
 * @property string $content_name
 * @property int $content_type
 * @property string $content_description
 * @property string $author_name
 * @property string $author_comment
 * @property string $file_name
 * @property string $expiry_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ContentAssign[] $contentAssigns
 * @property User $user
 * @property User $authorName
 * @property MasterContentTemplates $contentType
 */
class Contents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    
    public static function tableName()
    {
        return 'contents';
    }

    /**
     * @inheritdoc
     */
    
//    public $file;
    public function rules()
    {
        return [
            [['user_id', 'content_name', 'content_type', 'content_description', 'author_name', 'author_comment', 'file_name', 'expiry_date', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'content_type'], 'integer'],
            [['content_description', 'author_comment'], 'string'],
            [['expiry_date', 'created_at', 'updated_at'], 'safe'],
//            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'PDF, pdf'],
            [['content_name', 'author_name', 'file_name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['author_name'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_name' => 'email']],
            [['content_type'], 'exist', 'skipOnError' => true, 'targetClass' => MasterContentTemplates::className(), 'targetAttribute' => ['content_type' => 'id']],
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
            'content_name' => 'Content Name',
            'content_type' => 'Content Type',
            'content_description' => 'Content Description',
            'author_name' => 'Author Name',
            'author_comment' => 'Author Comment',
            'file_name' => 'File Name',
            'expiry_date' => 'Expiry Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentAssigns()
    {
        return $this->hasMany(ContentAssign::className(), ['content_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorName()
    {
        return $this->hasOne(User::className(), ['email' => 'author_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentType()
    {
        return $this->hasOne(MasterContentTemplates::className(), ['id' => 'content_type']);
    }
    
    
    
    
   
    
//    public function upload()
//    {
//        if ($this->validate()) {
//            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
//            return true;
//        } else {
//            return false;
//        }
//    }

    
    
}
