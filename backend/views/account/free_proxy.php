<?php

/* @var $this yii\web\View */

use backend\models\Person;

$this->title = 'ROBOTS Corporation Inventory';

$sql = "
SELECT
  a.login as login_proxy,
  a.password as password_proxy,
  s.code as address_proxy
FROM
  tag t
JOIN tag_service ts
  on t.id = ts.tag_id
JOIN service s
    on ts.service_id = s.id
JOIN account a
    on s.id = a.service_id
LEFT JOIN person_account pa
    ON a.id = pa.account_id
WHERE
  t.code = 'PROXY'
  AND pa.id IS NULL;
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
                proxy address
            </th>
            <th>
                proxy login
            </th>
            <th>
                proxy password
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
                    <?= $row['address_proxy'] ?>
                </td>
                <td>
                    <?= $row['login_proxy'] ?>
                </td>
                <td>
                    <?= $row['password_proxy'] ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>

