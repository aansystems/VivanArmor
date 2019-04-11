<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[MasterHipaaCategory]].
 *
 * @see MasterHipaaCategory
 */
class MasterHipaaCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MasterHipaaCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MasterHipaaCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
