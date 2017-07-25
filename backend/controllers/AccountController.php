<?php

namespace backend\controllers;

use backend\models\Account;
use backend\models\AccountSearch;
use backend\models\Person;
use backend\models\TagAccount;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
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
                        'actions' => ['index','view','update', 'free_proxy','link','unlink'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index','view','create','update','delete'],
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

    public function actionLink($person_id)
    {
        $person_id = intval($person_id);
        $person = Person::find()->where('id = :ID',['ID'=>$person_id])->one();

        $searchModel = new AccountSearch();
        $dataProvider = self::setAccountProvider();

        return $this->render('link', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'person_id' => $person_id,
            'person'=>$person
        ]);
    }

    public function actionUnlink($tag_id,$account_id)
    {
        $account_id = intval($account_id);
        $tag_id = intval($tag_id);

        TagAccount::UnlinkTag($tag_id, $account_id);

        $tagProvider = self::setTagProvider($account_id);

        return $this->renderPartial('tag_account', [
            'accountProvider' => $tagProvider,
        ]);

    }

    /**
     * Lists all Inventory.
     * @return mixed
     */
    public function actionFree_proxy()
    {
        return $this->render('free_proxy');
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $id = intval($id);

        $tagProvider = self::setTagProvider($id);
        $model = $this->findModel($id);
        $personAccount = $model->getPersonAccount()->one();

        $isEmpty = empty($personAccount);
        $person = new Person();
        if(!$isEmpty){
            $person = Person::findOne($personAccount->person_id);
        }

        return $this->render('view', [
            'model' => $model,
            'tagProvider' => $tagProvider,
            'person'=>$person
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
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
            $tagProvider = self::setTagProvider($id);

            return $this->render('update', [
                'model' => $model,
                'tagProvider' => $tagProvider
            ]);
        }
    }

    /**
     * Deletes an existing Account model.
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
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return ActiveDataProvider
     * @internal param $id
     */
    private static function setAccountProvider(): ActiveDataProvider
    {
        $query = (new Query())
            ->select([
                'is_hidden'=>'a.is_hidden',
                'account_id' => 'a.id',
                'service' => 's.code',
                'login' => 'a.login',
                'password' => 'a.password',
                'description' => 'a.description',
            ])
            ->from('account a')
            ->innerJoin('service s', 'a.service_id = s.id')
            ->leftJoin('person_account pa', 'a.id = pa.account_id')
            ->where('pa.account_id IS NULL');

        $accountProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $accountProvider->setSort([
            'attributes' => [
                'is_hidden',
                'service',
                'login',
                'password',
                'description',
            ],
            'defaultOrder' => ['service' => SORT_DESC],
        ]);

        return $accountProvider;
    }

    /**
     * @param $accountId
     * @return ActiveDataProvider
     */
    private static function setTagProvider(int $accountId): ActiveDataProvider
    {

        $query = (new Query())
            ->select([
                'account_id' => 'ta.account_id',
                'tag_id' => 'ta.tag_id',
                'code' => 't.code',
                'title' => 't.title',
                'description' => 't.description',
            ])
            ->from('account a')
            ->innerJoin('tag_account ta', 'a.id = ta.account_id')
            ->innerJoin('tag t', 'ta.tag_id = t.id')
            ->where('a.id = :ID', ['ID' => $accountId]);

        $accountProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $accountProvider->setSort([
            'attributes' => [
                'code',
                'title',
                'description',
            ],
            'defaultOrder' => ['code' => SORT_DESC],
        ]);

        return $accountProvider;
    }
}
