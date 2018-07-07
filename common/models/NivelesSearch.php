<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Niveles;

/**
 * NivelesSearch represents the model behind the search form of `backend\models\Niveles`.
 */
class NivelesSearch extends Niveles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Nivel', 'Valor', 'Id_Control'], 'integer'],
            [['Descripcion'], 'safe'],
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
        $query = Niveles::find();

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
            'Id_Nivel' => $this->Id_Nivel,
            'Valor' => $this->Valor,
            'Id_Control' => $this->Id_Control,
        ]);

        $query->andFilterWhere(['like', 'Descripcion', $this->Descripcion]);

        return $dataProvider;
    }
}
