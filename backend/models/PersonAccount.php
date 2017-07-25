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
            'id' => 'Идентификатор',
            'insert_date' => 'Дата добавления',
            'is_hidden' => 'Скрытая',
            'person_id' => 'Ссылка на Человека',
            'account_id' => 'Ссылка на Аккаунт',
        ];
    }

    /**
     * @param $person_id
     * @param $account_id
     * @return int
     */
    public static function UnlinkAccount(int $person_id, int $account_id):int
    {
        $model = PersonAccount::find()
            ->where('person_id = :PERSON AND account_id = :ACCOUNT',
                ['PERSON' => $person_id, 'ACCOUNT' => $account_id])
            ->one();

        $isEmpty = empty($model);
        $deleteResult = false;
        if (!$isEmpty) {
            $deleteResult = $model->delete();
        }

        $result = -1;
        if ($deleteResult !== false ){
            $result = $deleteResult;
        }

        return $result;
    }

    /**
     * @param $keys
     * @param $person_id
     */
    public static function linkAccountWithPerson($keys, $person_id)
    {
        foreach ($keys as $account_id) {
            $model = new PersonAccount();
            $model->account_id = $account_id;
            $model->person_id = $person_id;
            $model->save();
        }
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
