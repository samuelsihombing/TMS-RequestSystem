<?php

namespace backend\controllers;

use common\models\Request;
use common\models\RequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{
    /**
     * @inheritDoc
     */
    
   public function behaviors()
{
    return array_merge(
        parent::behaviors(),
        [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create','dashboard'],
                        'roles' => ['createRequest'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'approve', 'reject', 'complete'],
                        'roles' => ['approveRequest'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'approve', 'reject', 'complete'],
                        'roles' => ['manageMasterData'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]
    );
}
public function actionDashboard()
{
    $totalPending = Request::find()->where(['status' => Request::STATUS_PENDING])->count();
    $totalApproved = Request::find()->where(['status' => Request::STATUS_APPROVED])->count();
    $totalCompleted = Request::find()->where(['status' => Request::STATUS_COMPLETED])->count();
    $totalHighPriority = Request::find()->where(['status' => Request::STATUS_PENDING, 'priority' => Request::PRIORITY_HIGH])->count();

    return $this->render('dashboard', [
        'totalPending' => $totalPending,
        'totalApproved' => $totalApproved,
        'totalCompleted' => $totalCompleted,
        'totalHighPriority' => $totalHighPriority,
    ]);
}

    /**
     * Lists all Request models.
     *
     * @return string
     */
   public function actionIndex()
{
    $searchModel = new RequestSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    $totalAll = Request::find()->count();
    $totalPending = Request::find()->where(['status' => Request::STATUS_PENDING])->count();
    $totalApproved = Request::find()->where(['status' => Request::STATUS_APPROVED])->count();
    $totalCompleted = Request::find()->where(['status' => Request::STATUS_COMPLETED])->count();

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'totalAll' => $totalAll,
        'totalPending' => $totalPending,
        'totalApproved' => $totalApproved,
        'totalCompleted' => $totalCompleted,
    ]);
}

    /**
     * Displays a single Request model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Request();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->user_id=Yii::$app->user->id;
                if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionApprove($id)
{
    $model = $this->findModel($id);
    if ($model->approve(Yii::$app->user->id)) {
        Yii::$app->session->setFlash('success', 'Request berhasil di-approve.');
    }
    return $this->redirect(['view', 'id' => $id]);
}

public function actionReject($id)
{
    $model = $this->findModel($id);
    if ($model->reject(Yii::$app->user->id)) {
        Yii::$app->session->setFlash('success', 'Request berhasil di-reject.');
    }
    return $this->redirect(['view', 'id' => $id]);
}

public function actionComplete($id)
{
    $model = $this->findModel($id);
    if ($model->complete(Yii::$app->user->id)) {
        Yii::$app->session->setFlash('success', 'Request ditandai selesai.');
    }
    return $this->redirect(['view', 'id' => $id]);
}

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
