<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[CyberResiliencyIndexLog]].
 *
 * @see CyberResiliencyIndexLog
 */
class CyberResiliencyIndexLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CyberResiliencyIndexLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CyberResiliencyIndexLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
