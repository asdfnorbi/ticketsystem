<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ticket;
use yii\data\Sort;
use yii\db\Expression;
use yii\data\SqlDataProvider;
/**
 * TicketSearch represents the model behind the search form of `app\models\Ticket`.
 */
class TicketSearch extends Ticket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'priority', 'user_id'], 'integer'],
            [['title', 'shortDescribe', 'longDescribe', 'problemTheme'], 'safe'],
            [['open'], 'boolean'],
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
        $query = Ticket::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'open' => $this->open,
            'id' => $this->id,
            'priority' => $this->priority,
            'user_id' => $this->user_id,

        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'shortDescribe', $this->shortDescribe])
            ->andFilterWhere(['ilike', 'longDescribe', $this->longDescribe])
            ->andFilterWhere(['ilike', 'problemTheme', $this->problemTheme]);

        return $dataProvider;
    }
}
