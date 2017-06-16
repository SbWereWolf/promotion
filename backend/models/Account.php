<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $service_id
 * @property string $login
 * @property string $password
 * @property string $description
 *
 * @property Service $service
 * @property AccountPost[] $accountPosts
 * @property Post[] $posts
 * @property PersonAccount $personAccount
 * @property TagAccount[] $tagAccounts
 * @property Tag[] $tags
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['service_id'], 'integer'],
            [['login', 'password', 'description'], 'string'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
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
            'service_id' => 'Ссылка на Сервис',
            'login' => 'Логин',
            'password' => 'Пароль',
            'description' => 'Примечание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id'])->inverseOf('accounts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountPosts()
    {
        return $this->hasMany(AccountPost::className(), ['account_id' => 'id'])->inverseOf('account');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('account_post', ['account_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonAccount()
    {
        return $this->hasOne(PersonAccount::className(), ['account_id' => 'id'])->inverseOf('account');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagAccounts()
    {
        return $this->hasMany(TagAccount::className(), ['account_id' => 'id'])->inverseOf('account');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('tag_account', ['account_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountQuery(get_called_class());
    }
}
