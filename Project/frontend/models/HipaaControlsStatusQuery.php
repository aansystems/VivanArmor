<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[HipaaControlsStatus]].
 *
 * @see HipaaControlsStatus
 */
class HipaaControlsStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return HipaaControlsStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return HipaaControlsStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
