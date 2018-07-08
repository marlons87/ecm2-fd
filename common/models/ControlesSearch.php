<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Controles;

/**
 * ControlesSearch represents the model behind the search form of `backend\models\Controles`.
 */
class ControlesSearch extends Controles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Control', 'Id_Dominio'], 'integer'],
            [['Nombre', 'Codigo'], 'safe'],
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
        $query = Controles::find();

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
            'Id_Control' => $this->Id_Control,
            'Id_Dominio' => $this->Id_Dominio,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Codigo', $this->Codigo]);

        return $dataProvider;
    }
}
