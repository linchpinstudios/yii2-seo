<?php

namespace linchpinstudios\seo\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use linchpinstudios\seo\models\SeoPages;

/**
 * SeoPagesSearch represents the model behind the search form about `linchpinstudios\seo\models\SeoPages`.
 */
class SeoPagesSearch extends SeoPages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['view', 'action_params'], 'safe'],
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
        $query = SeoPages::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'action_params', $this->action_params]);

        return $dataProvider;
    }
}
