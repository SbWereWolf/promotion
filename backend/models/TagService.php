<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tag_service".
 *
 * @property integer $id
 * @property string $insert_date
 * @property boolean $is_hidden
 * @property integer $tag_id
 * @property integer $service_id
 *
 * @property Service $service
 * @property Tag $tag
 */
class TagService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
            [['tag_id', 'service_id'], 'integer'],
            [['tag_id', 'service_id'], 'unique', 'targetAttribute' => ['tag_id', 'service_id'], 'message' => 'The combination of Tag ID and Service ID has already been taken.'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['service_id' => 'id']],
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
            'service_id' => 'Service ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id'])->inverseOf('tagServices');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id'])->inverseOf('tagServices');
    }

    /**
     * @inheritdoc
     * @return TagServiceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagServiceQuery(get_called_class());
    }
}
