<?php

namespace linchpinstudios\seo;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'linchpinstudios\seo\controllers';
    
    public $ignoreParams = false;
    
    public $trackViews = true;
    

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
