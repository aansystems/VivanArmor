<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[MasterHipaaControl]].
 *
 * @see MasterHipaaControl
 */
class MasterHipaaControlQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MasterHipaaControl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MasterHipaaControl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
