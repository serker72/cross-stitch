<?php

namespace app\modules\main\controllers;

use Yii;
use app\modules\main\models\KscdPosts;
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
        $dataProvider = new ArrayDataProvider([
            'allModels' => $model->kscdComments,
        ]);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
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
