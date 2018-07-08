<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sedes".
 *
 * @property int $Id_Sede
 * @property string $Nombre
 * @property string $Ubicacion
 * @property int $Id_Institucion
 * @property string $Fecha_Creacion
 * @property int $Id_Usuario
 *
 * @property Evaluaciones[] $evaluaciones
 * @property Instituciones $institucion
 * @property User $usuario
 */
class Sedes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sedes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nombre', 'Id_Institucion', 'Id_Usuario'], 'required'],
            [['Id_Institucion', 'Id_Usuario'], 'integer'],
            [['Fecha_Creacion'], 'safe'],
            [['Nombre'], 'string', 'max' => 100],
            [['Ubicacion'], 'string', 'max' => 250],
            [['Id_Institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['Id_Institucion' => 'Id_Institucion']],
            [['Id_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_Usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id_Sede' => 'Id_Sede',
            'Nombre' => 'Nombre',
            'Ubicacion' => 'Ubicación',
            'Id_Institucion' => 'Id  Institucion',
            'Fecha_Creacion' => 'Fecha de creación',
            'Id_Usuario' => 'Id  Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluaciones()
    {
        return $this->hasMany(Evaluaciones::className(), ['Id_Sede' => 'Id_Sede']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucion()
    {
        return $this->hasOne(Instituciones::className(), ['Id_Institucion' => 'Id_Institucion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_Usuario']);
    }

    /**
     * {@inheritdoc}
     * @return SedesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SedesQuery(get_called_class());
    }

}
