<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property int $user_id
 * @property string $document_name
 * @property string $document_type
 * @property string $document_description
 * @property string $author_comment
 * @property string $file_name
 * @property string $folder_name
 * @property int $status
 */


class Documents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documents';
    }

    
public $file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'document_name', 'document_type', 'document_description', 'author_comment', 'file_name', 'folder_name'], 'required'],
            [['user_id', 'status'], 'integer'],
             [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'DOCX.doc,docx,pdf,DOC'],
            [['document_description', 'author_comment'], 'string'],
            [['document_name', 'document_type', 'file_name', 'folder_name'], 'string', 'max' => 255],
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
            'document_name' => 'Document Name',
            'document_type' => 'Document Type',
            'document_description' => 'Document Description',
            'author_comment' => 'Author Comment',
            'file_name' => 'File Name',
            'folder_name' => 'Folder Name',
            'status' => 'Status',
        ];
    }
    
    
        public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

}
