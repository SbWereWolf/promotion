<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ServiceAccount]].
 *
 * @see ServiceAccount
 */
class ServiceAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ServiceAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ServiceAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
