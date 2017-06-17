<?php

/* @var $this yii\web\View */

use backend\models\Person;

$this->title = 'ROBOTS Corporation Inventory';

$sql = "
SELECT 
  (
  SELECT 
  a.login 
  FROM person ps 
  JOIN person_account pa
  ON ps.id = pa.person_id
  JOIN account a 
  ON pa.account_id = a.id
  JOIN service s ON 
  a.service_id = s.id
  WHERE
   ps.id = p.id
   AND s.code = 'MAIL_RU'
  ) AS login_mail_ru, 
  (
  SELECT 
  a.password 
  FROM person ps 
  JOIN person_account pa
  ON ps.id = pa.person_id
  JOIN account a 
  ON pa.account_id = a.id
  JOIN service s ON 
  a.service_id = s.id
  WHERE
   ps.id = p.id
   AND s.code = 'MAIL_RU'
  ) AS password_mail_ru,
  (
  SELECT 
  a.login 
  FROM person ps 
  JOIN person_account pa
  ON ps.id = pa.person_id
  JOIN account a 
  ON pa.account_id = a.id
  JOIN service s ON 
  a.service_id = s.id
  WHERE
   ps.id = p.id
   AND s.code = 'PIKABU_RU'
  ) AS login_pikabu_ru, 
  (
  SELECT 
  a.password 
  FROM person ps 
  JOIN person_account pa
  ON ps.id = pa.person_id
  JOIN account a 
  ON pa.account_id = a.id
  JOIN service s ON 
  a.service_id = s.id
  WHERE
   ps.id = p.id
   AND s.code = 'PIKABU_RU'
  ) AS password_pikabu_ru,
  (
  SELECT 
  a.login 
  FROM person ps 
  JOIN person_account pa
  ON ps.id = pa.person_id
  JOIN account a 
  ON pa.account_id = a.id
  JOIN service s ON 
  a.service_id = s.id
  JOIN tag_service ts 
  ON s.id = ts.service_id
  JOIN tag t 
  ON ts.tag_id = t.id
  WHERE
   ps.id = p.id
   AND t.code = 'PROXY'
  ) AS login_proxy, 
  (
  SELECT 
  a.password 
  FROM person ps 
  JOIN person_account pa
  ON ps.id = pa.person_id
  JOIN account a 
  ON pa.account_id = a.id
  JOIN service s ON 
  a.service_id = s.id
  JOIN tag_service ts 
  ON s.id = ts.service_id
  JOIN tag t 
  ON ts.tag_id = t.id
  WHERE
   ps.id = p.id
   AND t.code = 'PROXY'
  ) AS password_proxy, 
  (
  SELECT 
  s.code 
  FROM person ps 
  JOIN person_account pa
  ON ps.id = pa.person_id
  JOIN account a 
  ON pa.account_id = a.id
  JOIN service s ON 
  a.service_id = s.id
  JOIN tag_service ts 
  ON s.id = ts.service_id
  JOIN tag t 
  ON ts.tag_id = t.id
  WHERE
   ps.id = p.id
   AND t.code = 'PROXY'
  ) AS address_proxy
  
FROM 
  person p
;
";

$query = Person::getDb()->createCommand($sql)->query();
$data = $query->readAll();

$dataCount = count($data);
$isExists = $dataCount > 0;

if($isExists):
    ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                proxy login
            </th>
            <th>
                proxy password
            </th>
            <th>
                proxy
            </th>
            <th>
                pikabu login
            </th>
            <th>
                pikabu password
            </th>
            <th>
                mail login
            </th>
            <th>
                mail password
            </th>
        </tr>
        </thead>
        <tfoot>

        </tfoot>

        <?php foreach ( $data as $index => $row ):
            ?>
            <tr>
                <td>
                    <?= $index ?>
                </td>
                <td>
                    <?= $row['login_proxy'] ?>
                </td>
                <td>
                    <?= $row['password_proxy'] ?>
                </td>
                <td>
                    <?= $row['address_proxy'] ?>
                </td>
                <td>
                    <?= $row['login_pikabu_ru'] ?>
                </td>
                <td>
                    <?= $row['password_pikabu_ru'] ?>
                </td>
                <td>
                    <?= $row['login_mail_ru'] ?>
                </td>
                <td>
                    <?= $row['password_mail_ru'] ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>

