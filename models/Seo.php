<?php

namespace linchpinstudios\seo\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use linchpinstudios\seo\models\SeoPages;

class Seo extends Model
{
    
    public $trackViews = true;
    
    public $metaTags = [];
    
    public $actionParams = [];
    
    public $route = '';
    
    public function run()
    {
        $this->setRoute( Yii::$app->controller->route );
        $this->setActionParams( Yii::$app->request->queryParams );
        $this->generatePageData();
        $this->processMetaTags();
        
    }
    
    
    public function setActionParams( $params = [] )
    {
        $array = $params;
        foreach($array as $key=>$value)
        {
            if(is_null($value) || $value == '')
                unset($array[$key]);
        }
        
        if(is_array($array)) {
            $this->actionParams = $array;
        }
        
    }
    
    
    public function setPageData( $pageData )
    {
        
        $this->pageData = $pageData;
        
    }
    
    
    public function setRoute( $route )
    {
        
        $this->route = $route;
        
    }
    
    
    public function setMetaTags( $meta, $merge = true )
    {
        
        foreach($meta as $v) {
            $metaTags[] = [
                'name' => $v->name,
                'content'   => $v->content,
            ];
        }
        if(empty($metaTags)){
            return true;
        }
        
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
        
        $where['action_params'] = json_encode($this->actionParams);
        
        
        $page = SeoPages::find()->where($where)->with('meta')->one();
        
        if( $this->trackViews && $page == null ) {
            $page               = new SeoPages();
            $page->view         = $this->route;
            $page->action_params = $this->actionParams;
            $page->save();
            
        } else {
            
            $this->setMetaTags( $page->meta );
            
        }
        
    }
    
    
    
    public function processMetaTags()
    {
        
        foreach( $this->metaTags as $tag ) {
            
            $this->registerMetaTag( $tag['name'], $tag['content']);
            
        }
        
    }
    
    
    public function registerMetaTag( $name, $content )
    {
        
        Yii::$app->view->registerMetaTag(['name' => $name, 'content' => $content]);
        
    }
    
}