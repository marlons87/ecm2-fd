<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "respuestas".
 *
 * @property int $Id_Respuesta
 * @property string $Observaciones
 * @property int $Id_Nivel
 * @property int $Id_Evaluacion
 * @property int $Id_Control
 *
 * @property Evaluaciones $evaluacion
 * @property Niveles $nivel
 * @property Controles $control
 */
class Respuestas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuestas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Nivel', 'Id_Evaluacion', 'Id_Control'], 'required'],
            [['Id_Nivel', 'Id_Evaluacion', 'Id_Control'], 'integer'],
            [['Observaciones'], 'string', 'max' => 300],
            [['Id_Evaluacion'], 'exist', 'skipOnError' => true, 'targetClass' => Evaluaciones::className(), 'targetAttribute' => ['Id_Evaluacion' => 'Id_Evaluacion']],
            [['Id_Nivel'], 'exist', 'skipOnError' => true, 'targetClass' => Niveles::className(), 'targetAttribute' => ['Id_Nivel' => 'Id_Nivel']],
            [['Id_Control'], 'exist', 'skipOnError' => true, 'targetClass' => Controles::className(), 'targetAttribute' => ['Id_Control' => 'Id_Control']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Respuesta' => 'Id  Respuesta',
            'Observaciones' => 'Observaciones',
            'Id_Nivel' => 'Id  Nivel',
            'Id_Evaluacion' => 'Id  Evaluacion',
            'Id_Control' => 'Id  Control',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluacion()
    {
        return $this->hasOne(Evaluaciones::className(), ['Id_Evaluacion' => 'Id_Evaluacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNivel()
    {
        return $this->hasOne(Niveles::className(), ['Id_Nivel' => 'Id_Nivel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControl()
    {
        return $this->hasOne(Controles::className(), ['Id_Control' => 'Id_Control']);
    }

    /**
     * @inheritdoc
     * @return RespuestasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RespuestasQuery(get_called_class());
    }
}
