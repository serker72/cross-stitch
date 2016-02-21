<?php

namespace app\modules\main\controllers;

use Yii;
use app\modules\main\models\KscdPosts;
use app\modules\main\models\KscdComments;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostsController implements the CRUD actions for KscdPosts model.
 */
class PostsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            /*'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],*/
        ];
    }
    
    /**
     * Lists all KscdPosts models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(isset($_GET['category_id'])) {
            $query = KscdPosts::getPostsByCategoryAndStatus($_GET['category_id'], 'publish');
            $category_name = Yii::$app->db->createCommand('SELECT name FROM kscd_categories WHERE id=:category_id', [':category_id' => $_GET['category_id']])->queryScalar();
        } else {
            $query = KscdPosts::getPostsByStatus('publish');
            $category_name = '';
        }
                
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_date' => SORT_DESC,
                    'title' => SORT_ASC, 
                ]
            ],            
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'category_name' => $category_name,
        ]);
    }

    /**
     * Displays a single KscdPosts model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $model_comment = $this->newComment($model);
        
        $dataProvider = new ArrayDataProvider([
            //'allModels' => $model->kscdComments,
            'allModels' => $model->kscdCommentsTree,
        ]);
        
        return $this->render('view', [
            'model' => $model,
            'model_comment' => $model_comment,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /*
     * Создание нового комментария
     */
    protected function newComment($post)
    {
        $comment = new KscdComments;
        
        if(isset($_POST['KscdComments']))
        {
            $comment->attributes = $_POST['KscdComments'];
            
            if($post->addComment($comment))
            {
                if($comment->approved == KscdComments::STATUS_PENDING)
                    Yii::$app->session->setFlash('commentSubmitted', 'Thank you for your comment. Your comment will be posted once it is approved.');
                $this->refresh();
            }
        }
        return $comment;
    }
    
    /**
     * Finds the KscdPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return KscdPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KscdPosts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
