<?php

namespace linchpinstudios\seo\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller
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
                        'actions' => ['index',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    
    public function actionIndex()
    {
        
        
        
        return $this->render('index', ['moduleId' => $this->module->id]);
    }
}
