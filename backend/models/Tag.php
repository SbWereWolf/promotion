<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property string $code
 * @property string $title
 * @property string $description
 *
 * @property TagAccount[] $tagAccounts
 * @property Account[] $accounts
 * @property TagService[] $tagServices
 * @property Service[] $services
 * @property TagServiceAccount[] $tagServiceAccounts
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
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
    public function getTagAccounts()
    {
        return $this->hasMany(TagAccount::className(), ['tag_id' => 'id'])->inverseOf('tag');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['id' => 'account_id'])->viaTable('tag_account', ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagServices()
    {
        return $this->hasMany(TagService::className(), ['tag_id' => 'id'])->inverseOf('tag');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])->viaTable('tag_service', ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagServiceAccounts()
    {
        return $this->hasMany(TagServiceAccount::className(), ['tag_id' => 'id'])->inverseOf('tag');
    }

    /**
     * @inheritdoc
     * @return TagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagQuery(get_called_class());
    }
}
