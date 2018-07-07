<?php

namespace backend\models\User;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $Nombre
 * @property string $Apellido1
 * @property string $Apellido2
 * @property string $Puesto
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $Id_Institucion
 *
 * @property Evaluaciones[] $evaluaciones
 * @property Instituciones $institucion
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'Nombre', 'Apellido1', 'Apellido2', 'Puesto', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'Id_Institucion'], 'required'],
            [['status', 'created_at', 'updated_at', 'Id_Institucion'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['Nombre'], 'string', 'max' => 50],
            [['Apellido1', 'Apellido2'], 'string', 'max' => 30],
            [['Puesto'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['Id_Institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['Id_Institucion' => 'Id_Institucion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'Nombre' => 'Nombre',
            'Apellido1' => 'Apellido1',
            'Apellido2' => 'Apellido2',
            'Puesto' => 'Puesto',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'Id_Institucion' => 'Id  Institucion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvaluaciones()
    {
        return $this->hasMany(Evaluaciones::className(), ['Id_Usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucion()
    {
        return $this->hasOne(Instituciones::className(), ['Id_Institucion' => 'Id_Institucion']);
    }
}
