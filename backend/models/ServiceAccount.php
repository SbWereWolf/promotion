<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service_account".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $service_id
 * @property string $login
 * @property string $password
 * @property string $description
 *
 * @property PersonServiceAccount $personServiceAccount
 * @property Service $service
 * @property TagServiceAccount[] $tagServiceAccounts
 */
class ServiceAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_account';
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
            [['service_id', 'login'], 'unique', 'targetAttribute' => ['service_id', 'login'], 'message' => 'The combination of Service ID and Login has already been taken.'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
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
            'service_id' => 'Service ID',
            'login' => 'Login',
            'password' => 'Password',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonServiceAccount()
    {
        return $this->hasOne(PersonServiceAccount::className(), ['service_account_id' => 'id'])->inverseOf('serviceAccount');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id'])->inverseOf('serviceAccounts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagServiceAccounts()
    {
        return $this->hasMany(TagServiceAccount::className(), ['service_account_id' => 'id'])->inverseOf('serviceAccount');
    }

    /**
     * @inheritdoc
     * @return ServiceAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiceAccountQuery(get_called_class());
    }
}
