<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "evaluaciones".
 *
 * @property int $Id_Evaluacion
 * @property int $Consecutivo
 * @property string $Fecha
 * @property int $Status
 * @property int $Id_Usuario
 * @property int $Id_Institucion
 * @property string $Fecha_Ultima_Modificacion
 *
 * @property User $usuario
 * @property Instituciones $institucion
 * @property Respuestas[] $respuestas
 */
class Evaluaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evaluaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Consecutivo', 'Id_Usuario', 'Id_Sede'], 'integer'],
            [['Fecha', 'Fecha_Ultima_Modificacion'], 'safe'],
            [['Id_Usuario', 'Id_Sede'], 'required'],
            [['Status'], 'string', 'max' => 1],
            [['descripcion'], 'string', 'max' => 250],
            [['Id_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_Usuario' => 'id']],
            [['Id_Sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['Id_Sede' => 'Id_Sede']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Evaluacion' => 'Id  Evaluacion',
            'Consecutivo' => 'Consecutivo',
            'Fecha' => 'Fecha',
            'Status' => 'Status',
            'Id_Usuario' => 'Id  Usuario',
            'Id_Sede' => 'Sede',
            'Fecha_Ultima_Modificacion' => 'Fecha  Ultima  Modificacion',
            'descripcion'=>'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_Usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSedes()
    {
        return $this->hasOne(Sedes::className(), ['Id_Sede' => 'Id_Sede']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuestas::className(), ['Id_Evaluacion' => 'Id_Evaluacion']);
    }
    
    /**
     * @inheritdoc
     * @return EvaluacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EvaluacionesQuery(get_called_class());
    }
}
