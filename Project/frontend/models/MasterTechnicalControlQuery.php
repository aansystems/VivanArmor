<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[MasterTechnicalControl]].
 *
 * @see MasterTechnicalControl
 */
class MasterTechnicalControlQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MasterTechnicalControl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MasterTechnicalControl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
