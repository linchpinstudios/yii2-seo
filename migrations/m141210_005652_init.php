<?php

use yii\db\Schema;
use yii\db\Migration;

class m141210_005652_init extends Migration
{
    public function safeup()
    {
        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%seo_pages}}',[
            'id'            => Schema::TYPE_PK,
            'view'          => Schema::TYPE_STRING . '(255)',
            'action_params'  => Schema::TYPE_STRING . '(555)',
        ],$tableOptions);
    
        $this->createTable('{{%seo_meta}}',[
            'id'            => Schema::TYPE_PK,
            'page_id'          => Schema::TYPE_INTEGER . '(11)',
            'name'          => Schema::TYPE_STRING . '(45)',
            'content'       => Schema::TYPE_STRING . '(255)',
            'date_modified' => Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ],$tableOptions);
        
    }

    public function safedown()
    {
        
        $this->dropTable('{{%seo_pages}}');
        $this->dropTable('{{%seo_meta}}');
        
    }
}
