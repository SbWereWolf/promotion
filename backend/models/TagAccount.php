<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tag_account".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $tag_id
 * @property integer $account_id
 *
 * @property Account $account
 * @property Tag $tag
 */
class TagAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['tag_id', 'account_id'], 'integer'],
            [['tag_id', 'account_id'], 'unique', 'targetAttribute' => ['tag_id', 'account_id'], 'message' => 'The combination of Tag ID and Account ID has already been taken.'],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
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
            'account_id' => 'Account ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id'])->inverseOf('tagAccounts');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id'])->inverseOf('tagAccounts');
    }

    /**
     * @inheritdoc
     * @return TagAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagAccountQuery(get_called_class());
    }
}
