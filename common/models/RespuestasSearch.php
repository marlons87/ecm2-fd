<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Respuestas;

/**
 * RespuestasSearch represents the model behind the search form of `common\models\Respuestas`.
 */
class RespuestasSearch extends Respuestas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Respuesta', 'Id_Nivel', 'Id_Evaluacion', 'Id_Control'], 'integer'],
            [['Observaciones'], 'safe'],
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
        $query = Respuestas::find();

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
            'Id_Respuesta' => $this->Id_Respuesta,
            'Id_Nivel' => $this->Id_Nivel,
            'Id_Evaluacion' => $this->Id_Evaluacion,
            'Id_Control' => $this->Id_Control,
        ]);

        $query->andFilterWhere(['like', 'Observaciones', $this->Observaciones]);

        return $dataProvider;
    }
}
