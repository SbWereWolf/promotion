<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[TagAccount]].
 *
 * @see TagAccount
 */
class TagAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
