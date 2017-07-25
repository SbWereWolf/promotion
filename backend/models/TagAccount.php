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
            [['tag_id', 'account_id'], 'unique', 'targetAttribute' => ['tag_id', 'account_id'], 'message' => 'The combination of Ссылка на Тэг and Ссылка на Аккаунт has already been taken.'],
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
            'id' => 'Идентификатор',
            'insert_date' => 'Дата добавления',
            'is_hidden' => 'Скрытая',
            'tag_id' => 'Ссылка на Тэг',
            'account_id' => 'Ссылка на Аккаунт',
        ];
    }

    /**
     * @param array $keys
     * @param int $account_id
     * @internal param $person_id
     */
    public static function linkAccountWithTag(array $keys, int $account_id)
    {
        foreach ($keys as $tag_id) {
            $model = new TagAccount();
            $model->tag_id = $tag_id;
            $model->account_id = $account_id;
            $model->save();
        }
    }

    /**
     * @param int $tag_id
     * @param int $account_id
     * @return int
     */
    public static function UnlinkTag(int $tag_id,int $account_id):int
    {
        $model = TagAccount::find()
            ->where('tag_id = :TAG AND account_id = :ACCOUNT',
                ['TAG' => $tag_id, 'ACCOUNT' => $account_id])
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
