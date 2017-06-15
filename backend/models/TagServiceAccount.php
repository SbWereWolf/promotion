<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tag_service_account".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $tag_id
 * @property integer $service_account_id
 *
 * @property ServiceAccount $serviceAccount
 * @property Tag $tag
 */
class TagServiceAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_service_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['tag_id', 'service_account_id'], 'integer'],
            [['service_account_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceAccount::className(), 'targetAttribute' => ['service_account_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
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
            'tag_id' => 'Tag ID',
            'service_account_id' => 'Service Account ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceAccount()
    {
        return $this->hasOne(ServiceAccount::className(), ['id' => 'service_account_id'])->inverseOf('tagServiceAccounts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id'])->inverseOf('tagServiceAccounts');
    }

    /**
     * @inheritdoc
     * @return TagServiceAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagServiceAccountQuery(get_called_class());
    }
}
