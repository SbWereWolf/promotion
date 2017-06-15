<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PersonAccount]].
 *
 * @see PersonAccount
 */
class PersonAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PersonAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PersonAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
