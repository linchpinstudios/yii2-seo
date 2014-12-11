<?php

namespace linchpinstudios\seo\controllers;

use Yii;
use yii\filters\AccessControl;
use linchpinstudios\seo\models\SeoMeta;
use linchpinstudios\seo\models\SeoMetaSearch;
use linchpinstudios\seo\models\SeoPages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UrlManager;

/**
 * SeoMetaController implements the CRUD actions for SeoMeta model.
 */
class SeoMetaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error',],
                        'allow' => ['true'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all SeoMeta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeoMetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SeoMeta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SeoMeta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeoMeta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            
            $pages = $this->findPagesArray();
            
            return $this->render('create', [
                'model' => $model,
                'pages' => $pages,
            ]);
        }
    }

    /**
     * Updates an existing SeoMeta model.
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
            
            $pages = $this->findPagesArray();
            
            return $this->render('update', [
                'model' => $model,
                'pages' => $pages,
            ]);
        }
    }

    /**
     * Deletes an existing SeoMeta model.
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
     * Finds the SeoMeta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SeoMeta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeoMeta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    protected function findPagesArray()
    {
        $pagesModel = SeoPages::find()->orderBy('view','query_params')->asArray()->all();
        
        $pageArray = [];
        
        foreach ($pagesModel as $value) {
            $params = [
                $value->view,
            ];
            $params = ArrayHelper::merge($params, $value->query_params);
            $pageArray[$value->id] = UrlManager::createUrl($params);
        }
        
        return ArrayHelper::map($pagesModel, 'id', 'view');
    }
}
