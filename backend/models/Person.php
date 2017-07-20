<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property string $code
 * @property string $title
 * @property string $description
 *
 * @property PersonAccount[] $personAccounts
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['code', 'title', 'description'], 'string'],
            [['code'], 'unique'],
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
            'code' => 'Код',
            'title' => 'Наименование',
            'description' => 'Примечание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonAccounts()
    {
        return $this->hasMany(PersonAccount::className(), ['person_id' => 'id'])->inverseOf('person');
    }

    /**
     * @inheritdoc
     * @return PersonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonQuery(get_called_class());
    }
}
