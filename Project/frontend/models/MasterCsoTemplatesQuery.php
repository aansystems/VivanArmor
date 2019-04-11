<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[MasterCsoTemplates]].
 *
 * @see MasterCsoTemplates
 */
class MasterCsoTemplatesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return MasterCsoTemplates[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return MasterCsoTemplates|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
