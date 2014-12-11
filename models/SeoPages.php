<?php

namespace linchpinstudios\seo\models;

use Yii;
use linchpinstudios\seo\models\SeoMeta;

/**
 * This is the model class for table "seo_pages".
 *
 * @property integer $id
 * @property string $view
 * @property string $action_params
 */
class SeoPages extends \yii\db\ActiveRecord
{
    
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->action_params = json_encode($this->action_params);
            return true;
        } else {
            return false;
        }
    }
    
    
    public function afterFind( )
    {
        
        $this->action_params = json_decode($this->action_params);
        
        return true;
        
    }
    
    
    
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            SeoMeta::clearOld($this->id);
            return true;
        } else {
            return false;
        }
    }
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['view'], 'string', 'max' => 255],
            [['action_params'], 'string', 'max' => 555]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'view' => Yii::t('app', 'View'),
            'action_params' => Yii::t('app', 'Query Params'),
        ];
    }
    
    
    public function getMeta()
    {
        return $this->hasMany(SeoMeta::className(), ['page_id' => 'id']);
    }
    
}
