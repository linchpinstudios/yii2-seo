<?php

namespace linchpinstudios\seo\widgets;

use yii\base\Widget;
use yii\web\View;
use yii;

class MetaTags extends Widget
{
    
    public $action;
    
	public function run()
	{
        parent::run();
        error_log(print_r($this->action,true));
        
        $this->registerMetaTag(['keywords', 'This is a test']);
		//$model = BlogTerms::find()->orderBy('name')->all();

        //return $this->render('categories',['model' => $model,]);
	}
	
	public function renderCategories($categories){
    	
    	$items = [];
    	
    	foreach($categories as $category){
        	$items[] = $this->renderCategory($category);
    	}
    	
    	return implode("\n", $items); 
	}
	
	public function renderCategory($category){
        
        $catRender = '<li>';
        $catRender .= Html::a($category->name.' ('.count($category->blogTermRelationships).')',['blogposts/category', 'id' => $category->id, 'category' => $category->name]);
        $catRender .= '</li>';
        
        return $catRender;	
	}
}