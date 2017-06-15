<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property string $title
 * @property string $body
 *
 * @property AccountPost[] $accountPosts
 * @property Account[] $accounts
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['title', 'body'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'insert_date' => 'Insert Date',
            'is_hidden' => 'Is Hidden',
            'title' => 'Title',
            'body' => 'Body',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPosts()
    {
        return $this->hasMany(AccountPost::className(), ['post_id' => 'id'])->inverseOf('post');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['id' => 'account_id'])->viaTable('account_post', ['post_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}
