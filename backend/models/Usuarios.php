<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $Id_Usuario
 * @property string $Puesto
 * @property string $Email
 * @property int $Estado
 * @property int $Id_Institucion
 * @property int $Id_Rol
 *
 * @property Evaluaciones[] $evaluaciones
 * @property Instituciones $institucion
 * @property Roles $rol
 */
class Usuarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id_Institucion'], 'required'],
            [['Id_Institucion', 'Id_Rol'], 'integer'],
            [['Puesto'], 'string', 'max' => 100],
            [['Email'], 'string', 'max' => 75],
            [['Estado'], 'string', 'max' => 1],
            [['Id_Institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['Id_Institucion' => 'Id_Institucion']],
            [['Id_Rol'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['Id_Rol' => 'Id_Rol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Usuario' => 'Id  Usuario',
            'Puesto' => 'Puesto',
            'Email' => 'Email',
            'Estado' => 'Estado',
            'Id_Institucion' => 'Id  Institucion',
            'Id_Rol' => 'Id  Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluaciones()
    {
        return $this->hasMany(Evaluaciones::className(), ['Id_Usuario' => 'Id_Usuario']);
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
    public function getRol()
    {
        return $this->hasOne(Roles::className(), ['Id_Rol' => 'Id_Rol']);
    }
}
