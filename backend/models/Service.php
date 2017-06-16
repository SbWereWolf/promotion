<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property string $code
 * @property string $title
 * @property string $description
 *
 * @property Account[] $accounts
 * @property ServiceAccount[] $serviceAccounts
 * @property TagService[] $tagServices
 * @property Tag[] $tags
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
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
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['service_id' => 'id'])->inverseOf('service');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceAccounts()
    {
        return $this->hasMany(ServiceAccount::className(), ['service_id' => 'id'])->inverseOf('service');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTagServices()
    {
        return $this->hasMany(TagService::className(), ['service_id' => 'id'])->inverseOf('service');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('tag_service', ['service_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiceQuery(get_called_class());
    }
}
