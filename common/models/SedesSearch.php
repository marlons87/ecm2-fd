<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Sedes;

/**
 * SedesSearch represents the model behind the search form of `common\models\Sedes`.
 */
class SedesSearch extends Sedes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_Sede', 'Id_Institucion', 'Id_Usuario'], 'integer'],
            [['Nombre', 'Ubicacion', 'Fecha_Creacion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Sedes::find();

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
            'Id_Sede' => $this->Id_Sede,
            'Id_Institucion' => $this->Id_Institucion,
            'Fecha_Creacion' => $this->Fecha_Creacion,
            'Id_Usuario' => $this->Id_Usuario,
        ]);

        $query->andFilterWhere(['like', 'Nombre', $this->Nombre])
            ->andFilterWhere(['like', 'Ubicacion', $this->Ubicacion]);

        return $dataProvider;
    }
}
