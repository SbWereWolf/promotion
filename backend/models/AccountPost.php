<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "account_post".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $account_id
 * @property integer $post_id
 *
 * @property Account $account
 * @property Post $post
 */
class AccountPost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['account_id', 'post_id'], 'integer'],
            [['post_id', 'account_id'], 'unique', 'targetAttribute' => ['post_id', 'account_id'], 'message' => 'The combination of Ссылка на Аккаунт and Ссылка на Заметку has already been taken.'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Идентификатор',
            'insert_date' => 'Дата добавления',
            'is_hidden' => 'Скрытая',
            'account_id' => 'Ссылка на Аккаунт',
            'post_id' => 'Ссылка на Заметку',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id'])->inverseOf('accountPosts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id'])->inverseOf('accountPosts');
    }

    /**
     * @inheritdoc
     * @return AccountPostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountPostQuery(get_called_class());
    }
}
