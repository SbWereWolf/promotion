<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[TagService]].
 *
 * @see TagService
 */
class TagServiceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TagService[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TagService|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
