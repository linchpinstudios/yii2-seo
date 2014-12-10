<?php

namespace linchpinstudios\seo\models;

use Yii;
use linchpinstudios\seo\models\SeoPages;

/**
 * This is the model class for table "seo_meta".
 *
 * @property integer $id
 * @property integer $page
 * @property string $name
 * @property string $content
 * @property string $date_modified
 */
class SeoMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'integer'],
            [['date_modified'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'page_id' => Yii::t('app', 'Page'),
            'name' => Yii::t('app', 'Name'),
            'content' => Yii::t('app', 'Content'),
            'date_modified' => Yii::t('app', 'Date Modified'),
        ];
    }
    
    public function getPage()
    {
        return $this->hasOne(SeoPages::className(), ['id' => 'page_id']);
    }
}
