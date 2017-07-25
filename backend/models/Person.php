<?php

namespace backend\models;

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

    public function getLoginString(): string
    {
        $person_id = $this->id;

        $sql = "
SELECT
  ltrim(to_char(row_number()
                OVER (), '09')) ||
  ' http://'
  || -- proxy_login
  (SELECT sa.login
   FROM person ps
     JOIN person_account psa ON ps.id = psa.person_id
     JOIN account sa ON psa.account_id = sa.id
     JOIN service s ON sa.service_id = s.id
     JOIN tag_service ts ON s.id = ts.service_id
     JOIN tag t ON ts.tag_id = t.id
   WHERE ps.id = p.id AND t.code = 'PROXY')
  || ':'
  || -- proxy_password
  (SELECT sa.password
   FROM person ps
     JOIN person_account psa ON ps.id = psa.person_id
     JOIN account sa ON psa.account_id = sa.id
     JOIN service s ON sa.service_id = s.id
     JOIN tag_service ts ON s.id = ts.service_id
     JOIN tag t ON ts.tag_id = t.id
   WHERE ps.id = p.id AND t.code = 'PROXY')
  || '@'
  || -- proxy_address
  (SELECT s.code
   FROM person ps
     JOIN person_account psa ON ps.id = psa.person_id
     JOIN account sa ON psa.account_id = sa.id
     JOIN service s ON sa.service_id = s.id
     JOIN tag_service ts ON s.id = ts.service_id
     JOIN tag t ON ts.tag_id = t.id
   WHERE ps.id = p.id AND t.code = 'PROXY')
  || ' '
  || -- account_login
  (SELECT sa.login
   FROM person ps
     JOIN person_account psa ON ps.id = psa.person_id
     JOIN account sa ON psa.account_id = sa.id
     JOIN service s ON sa.service_id = s.id
   WHERE ps.id = p.id AND s.code = 'PIKABU_RU')
  || ' '
  || -- account_password
  (SELECT sa.password
   FROM person ps
     JOIN person_account psa ON ps.id = psa.person_id
     JOIN account sa ON psa.account_id = sa.id
     JOIN service s ON sa.service_id = s.id
   WHERE ps.id = p.id AND s.code = 'PIKABU_RU')
  || ' '
  || -- mail_login
  (SELECT sa.login
   FROM person ps
     JOIN person_account psa ON ps.id = psa.person_id
     JOIN account sa ON psa.account_id = sa.id
     JOIN service s ON sa.service_id = s.id
   WHERE ps.id = p.id AND s.code = 'MAIL_RU')
  || ' '
  || -- mail_password
  (SELECT sa.password
   FROM person ps
     JOIN person_account psa ON ps.id = psa.person_id
     JOIN account sa ON psa.account_id = sa.id
     JOIN service s ON sa.service_id = s.id
   WHERE ps.id = p.id AND s.code = 'MAIL_RU')
    AS person_account
FROM
  person p
WHERE
  p.id = :PERSON
  AND EXISTS(
      SELECT NULL
      FROM person ps
        JOIN person_account psa ON ps.id = psa.person_id
        JOIN account sa ON psa.account_id = sa.id
        JOIN service s ON sa.service_id = s.id
        JOIN tag_service ts ON s.id = ts.service_id
        JOIN tag t ON ts.tag_id = t.id
      WHERE ps.id = p.id AND t.code = 'PROXY'
  )
  AND EXISTS(
      SELECT NULL
      FROM person ps
        JOIN person_account psa ON ps.id = psa.person_id
        JOIN account sa ON psa.account_id = sa.id
        JOIN service s ON sa.service_id = s.id
      WHERE ps.id = p.id AND s.code = 'MAIL_RU'
  )
  AND EXISTS(
      SELECT NULL
      FROM person ps
        JOIN person_account psa ON ps.id = psa.person_id
        JOIN account sa ON psa.account_id = sa.id
        JOIN service s ON sa.service_id = s.id
      WHERE ps.id = p.id AND s.code = 'PIKABU_RU'
  )
  AND EXISTS(
      SELECT NULL
      FROM
        account a
        JOIN tag_account ta
          ON a.id = ta.account_id
        JOIN tag t
          ON ta.tag_id = t.id
        JOIN person_account pa
          ON a.id = pa.account_id
        JOIN person pe
          ON pa.person_id = pe.id
      WHERE
        pe.id = p.id
        AND t.code = 'RELIABLE'
        AND a.service_id =
            (
              SELECT id
              FROM service
              WHERE code = 'PIKABU_RU'
            )
        AND a.is_hidden = FALSE
  )
;
";

        $loginString = Person::getDb()->createCommand($sql)->bindParam('PERSON', $person_id)->queryScalar();

        return $loginString;

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
