<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dominios".
 *
 * @property int $Id_Dominio
 * @property string $Nombre
 * @property string $Codigo
 *
 * @property Controles[] $controles
 */
class Dominios extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'dominios';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['Nombre'], 'required','message' => 'Complete el nombre del Dominio.'],
            [['Codigo'], 'required','message' => 'Complete el Código del Dominio.'],
            [['Nombre'], 'string', 'max' => 100],
            [['Codigo'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'Id_Dominio' => 'ID',
            'Codigo' => 'Código',
            'Nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControles() {
        return $this->hasMany(Controles::className(), ['Id_Dominio' => 'Id_Dominio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlesList() {
        $Controles = \common\models\Controles::find()->all();
        $ControlesList = ArrayHelper::map($Controles, 'Id_Control', 'Nombre', 'Id_Dominio', 'Codigo');
        return $ControlesList;
    }

    public function getControlName() {
        return $this->Controles ? $this->$Controles->Controles : '- no definido -';
    }

}
