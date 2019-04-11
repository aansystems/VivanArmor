<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[TechnicalControlsStatus]].
 *
 * @see TechnicalControlsStatus
 */
class TechnicalControlsStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TechnicalControlsStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TechnicalControlsStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
