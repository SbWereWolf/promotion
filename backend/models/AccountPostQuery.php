<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[AccountPost]].
 *
 * @see AccountPost
 */
class AccountPostQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AccountPost[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AccountPost|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
