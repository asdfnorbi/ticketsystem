<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use app\models\Ticket;
use app\models\TicketSearch;
use yii\data\Sort;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;



/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
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

    /**
     * Lists all Ticket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $searchModel->open=0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->enableMultiSort = true;
        $dataProvider->sort->defaultOrder = [
            'open' => SORT_ASC,
            'ticketmodify' => SORT_DESC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionClosedlist(){
        $searchModel = new TicketSearch();
        $searchModel->open=1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->enableMultiSort = true;
        $dataProvider->sort->defaultOrder = [
            'open' => SORT_ASC,
            'ticketmodify' => SORT_DESC,
        ];
            return $this->render('closedlist', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);


    }

    public function actionTicketfromuser($id){
        $searchModel = new TicketSearch();
        $searchModel->user_id=$id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->enableMultiSort = true;
        $dataProvider->sort->defaultOrder = [
            'open' => SORT_ASC,
            'ticketmodify' => SORT_DESC,
        ];

        return $this->render('ticketfromuser', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Displays a single Ticket model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
     * Creates a new Ticket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ticket = new Ticket();
        if ($ticket->load(Yii::$app->request->post()) && $ticket->save()) {
            return $this->redirect(['view', 'id' => $ticket->id]);
        }

        return $this->render('create', [
            'model' => $ticket,
        ]);
    }

    /**
     * Updates an existing Ticket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



    /**
     * Deletes an existing Ticket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }



    /**
     * Finds the Ticket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



}
