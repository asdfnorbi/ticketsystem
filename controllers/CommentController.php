<?php

namespace app\controllers;

use app\models\Ticket;
use Yii;
use app\models\Comment;
use app\models\CommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new CommentSearch();
        $searchModel->ticket_id=$id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
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
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {

        $comment = new Comment();
        $connection = \Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try{
            if($comment->load(Yii::$app->request->post()) && $comment->save()){
                $comment->refresh();
            /**@var Ticket $ticket **/
                $ticket = $comment->getTicket()->one();
                $ticket->id;
                $ticket->open=Ticket::STATUS_OPEN;
                $ticket->ticketmodify = $comment->commenttime;
                $ticket->save();
                $transaction->commit();
                return $this->redirect(['view', 'id' => $comment->id]);
            }

        }
        catch (\Exception $e){
            $transaction->rollBack();
        }
        return $this->render('create', [
            'model' => $comment,
            'id' => $id,
        ]);



//        $comment = new Comment();
//        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
//            $comment->refresh();
//            /**@var Ticket $ticket **/
//            $ticket = $comment->getTicket()->one();
//            $ticket->id;
//            $ticket->open=Ticket::STATUS_OPEN;
//            $ticket->ticketmodify = $comment->commenttime;
//            $ticket->save();
//
//            return $this->redirect(['view', 'id' => $comment->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $comment,
//            'id' => $id,
//        ]);
    }

    /**
     * Updates an existing Comment model.
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
            'id' => $id,
        ]);
    }

    /**
     * Deletes an existing Comment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['ticket/index']);
    }

    /**
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
