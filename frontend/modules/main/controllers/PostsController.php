<?php

namespace app\modules\main\controllers;

use Yii;
use app\modules\main\models\KskPosts;
use app\modules\main\models\KskComments;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostsController implements the CRUD actions for KskPosts model.
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
     * Lists all KskPosts models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(isset($_GET['category_id'])) {
            $query = KskPosts::getPostsByCategoryAndStatus($_GET['category_id'], 'publish');
            $category_name = Yii::$app->db->createCommand('SELECT name FROM ksk_categories WHERE id=:category_id', [':category_id' => $_GET['category_id']])->queryScalar();
        } else {
            $query = KskPosts::getPostsByStatus('publish');
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
     * Displays a single KskPosts model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        
        $model_comment = $this->newComment($model);
        
        $model_other_posts = KskPosts::getOtherPostsByCategoryAndStatus($model->category_id, $model->status, $id);
        
        $category_name = Yii::$app->db->createCommand('SELECT name FROM ksk_categories WHERE id=:category_id', [':category_id' => $model->category_id])->queryScalar();
        //$category_name = $model->category->name;
        //$category_name = '';
        
        $dataProvider = new ArrayDataProvider([
            //'allModels' => $model->kskComments,
            'allModels' => $model->kskCommentsTree,
        ]);
        
        return $this->render('view', [
            'model' => $model,
            'model_comment' => $model_comment,
            'model_other_posts' => $model_other_posts,
            'dataProvider' => $dataProvider,
            'category_name' => $category_name,
        ]);
    }
    
    /*
     * Создание нового комментария
     */
    protected function newComment($post)
    {
        $comment = new KskComments;
        
        if(isset($_POST['KskComments']))
        {
            $comment->attributes = $_POST['KskComments'];
            
            if($post->addComment($comment))
            {
                if($comment->approved == KskComments::STATUS_PENDING)
                    Yii::$app->session->setFlash('commentSubmitted', 'Thank you for your comment. Your comment will be posted once it is approved.');
                $this->refresh();
            }
        }
        return $comment;
    }
    
    /**
     * Finds the KskPosts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return KskPosts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KskPosts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
