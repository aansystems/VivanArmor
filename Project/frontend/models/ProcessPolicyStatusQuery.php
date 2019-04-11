<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[ProcessPolicyStatus]].
 *
 * @see ProcessPolicyStatus
 */
class ProcessPolicyStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProcessPolicyStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProcessPolicyStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
