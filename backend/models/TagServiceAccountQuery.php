<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[TagServiceAccount]].
 *
 * @see TagServiceAccount
 */
class TagServiceAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagServiceAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagServiceAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
