<?php

namespace backend\controllers;

use backend\models\Person;
use backend\models\PersonAccount;
use backend\models\PersonSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','view','update','create','unlink'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','view','create','update','delete','unlink'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionUnlink($person_id,$account_id)
    {
        $account_id = intval($account_id);
        $person_id = intval($person_id);

        PersonAccount::UnlinkAccount($person_id, $account_id);

        $accountProvider = self::setAccountProvider($person_id);

        return $this->renderPartial('person_account', [
            'accountProvider' => $accountProvider,
        ]);

    }

    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Person model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id = intval($id);

        $accountProvider = self::setAccountProvider($id);

        $loginString = Person::findOne($id)->getLoginString();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'accountProvider' => $accountProvider,
            'loginString'=>$loginString,
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            $id = intval($id);
            $accountProvider = self::setAccountProvider($id);

            return $this->render('update', [
                'model' => $model,
                'accountProvider' => $accountProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param $id
     * @return ActiveDataProvider
     */
    private static function setAccountProvider(int $id): ActiveDataProvider
    {

        $query = (new Query())
            ->select([
                'account_id' => 'pa.account_id',
                'person_id' => 'pa.person_id',
                'service' => 's.code',
                'login' => 'a.login',
                'password' => 'a.password',
                'description' => 'a.description',
            ])
            ->from('person p')
            ->innerJoin('person_account pa', 'p.id = pa.person_id')
            ->innerJoin('account a', 'pa.account_id = a.id')
            ->innerJoin('service s', 'a.service_id = s.id')
            ->where('p.id = :ID', ['ID' => $id]);

        $accountProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $accountProvider->setSort([
            'attributes' => [
                'service',
                'login',
                'password',
                'description',
            ],
            'defaultOrder' => ['service' => SORT_DESC],
        ]);

        return $accountProvider;
    }
}
