<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "person_account".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $person_id
 * @property integer $account_id
 *
 * @property Account $account
 * @property Person $person
 */
class PersonAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['person_id', 'account_id'], 'integer'],
            [['account_id'], 'unique'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
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
            'account_id' => 'Account ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id'])->inverseOf('personAccount');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id'])->inverseOf('personAccounts');
    }

    /**
     * @inheritdoc
     * @return PersonAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonAccountQuery(get_called_class());
    }
}
