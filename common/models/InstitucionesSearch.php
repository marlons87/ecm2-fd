<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Instituciones;

/**
 * InstitucionesSearch represents the model behind the search form of `backend\models\Instituciones`.
 */
class InstitucionesSearch extends Instituciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Institucion'], 'integer'],
            [['Nombre'], 'safe'],
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
        $query = Instituciones::find();

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
            'Id_Institucion' => $this->Id_Institucion,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre]);

        return $dataProvider;
    }
}
