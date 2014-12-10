<?php

namespace linchpinstudios\seo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use linchpinstudios\seo\models\SeoMeta;

/**
 * SeoMetaSearch represents the model behind the search form about `linchpinstudios\seo\models\SeoMeta`.
 */
class SeoMetaSearch extends SeoMeta
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'page_id'], 'integer'],
            [['name', 'content', 'date_modified'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SeoMeta::find()->with('page');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'page_id' => $this->page_id,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
