<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[PersonServiceAccount]].
 *
 * @see PersonServiceAccount
 */
class PersonServiceAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return PersonServiceAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return PersonServiceAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
