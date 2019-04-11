<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "master_hipaa_category".
 *
 * @property int $id
 * @property string $category_name
 * @property string $fa_icon
 * @property string $description
 * @property string $links
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class MasterHipaaCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_hipaa_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'description', 'status'], 'required'],
            [['category_name', 'description', 'links'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['fa_icon'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_name' => 'Category Name',
            'fa_icon' => 'Fa Icon',
            'description' => 'Description',
            'links' => 'Links',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return MasterHipaaCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MasterHipaaCategoryQuery(get_called_class());
    }
}
