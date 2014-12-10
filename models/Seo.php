<?php

namespace linchpinstudios\seo\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use linchpinstudios\seo\models\SeoPages;

class Seo extends Model
{
    
    public $ignoreParams = false;
    
    public $trackViews = true;
    
    public $metaTags = [];
    
    public $queryParams = [];
    
    public $route = '';
    
    public $view;
    
    public function run()
    {
        
        $this->setView( Yii::$app->getView() );
        $this->setRoute( Yii::$app->controller->route );
        $this->setQueryParams( Yii::$app->request->queryParams );
        $this->generatePageData();
        $this->processMetaTags();
        
        
    }
    
    
    public function setView( $view )
    {
        
        $this->view = $view;
        
    }
    
    
    public function setQueryParams( $params )
    {
        
        $this->queryParams = $params;
        
    }
    
    
    public function setPageData( $pageData )
    {
        
        $this->pageData = $pageData;
        
    }
    
    
    public function setRoute( $route )
    {
        
        $this->route = $route;
        
    }
    
    
    public function setMetaTag( $metaTags, $merge = true )
    {
        
        if( $merge ) {
            $this->metaTags = ArrayHelper::merge( $this->metaTags, $metaTags );
        } else {
            $this->metaTags = $metaTags;
        }
        
    }
    
    
    public function generatePageData()
    {
        
        $where = [
            'view' => $this->route
        ];
        
        if( !$this->ignoreParams ) {
            $where['query_params'] = json_encode($this->queryParams);
        }
        
        $page = SeoPages::find()->where($where)->with('meta')->one();
        
        if( $this->trackViews && !$page  ) {
            $page               = new SeoPages();
            $page->view         = $this->route;
            $page->query_params = $this->queryParams;
            $page->save();
            
            error_log( print_r($page,true) );
            
        } else {
            
            $this->setMetaTag( $page->meta );
            
        }
        
    }
    
    
    
    public function processMetaTags()
    {
        
        foreach( $this->metaTags as $tag ) {
            
            $this->registerMetaTag( $tag->name, $tag->content);
            
        }
        
    }
    
    
    public function registerMetaTag( $name, $content )
    {
        
        $this->view->registerMetaTag(['name' => $name, 'content' => $content]);
        
    }
    
}