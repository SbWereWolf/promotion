<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "person_service_account".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $person_id
 * @property integer $service_account_id
 *
 * @property Person $person
 * @property ServiceAccount $serviceAccount
 */
class PersonServiceAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person_service_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['person_id', 'service_account_id'], 'integer'],
            [['service_account_id'], 'unique'],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
            [['service_account_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceAccount::className(), 'targetAttribute' => ['service_account_id' => 'id']],
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
            'person_id' => 'Person ID',
            'service_account_id' => 'Service Account ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id'])->inverseOf('personServiceAccounts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceAccount()
    {
        return $this->hasOne(ServiceAccount::className(), ['id' => 'service_account_id'])->inverseOf('personServiceAccount');
    }

    /**
     * @inheritdoc
     * @return PersonServiceAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonServiceAccountQuery(get_called_class());
    }
}
