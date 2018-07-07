<?php

namespace backend\models;
 
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $Nombre
 * @property string $Apellido1
 * @property string $Apellido2
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $Status
 * @property int $created_at
 * @property int $updated_at
 * @property int $Id_Rol
 *
 * @property Rol $rol
 */
class User extends \common\models\User
{
    public $password;
    public $passCompare;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'El nombre de usuario o “Alias” ya está siendo utilizado en este momento..'],
            ['username', 'string', 'min' => 9, 'max' => 15],
            
            [['Nombre'], 'string', 'max' => 50], [['Apellido1'], 'string', 'max' => 30], [['Apellido2'], 'string', 'max' => 30],
            
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'La dirección de correo ya está siendo utilizada.'],
            
            [ ['username', 'email'], 'unique', 'targetClass' => '\common\models\User', 'when' => function ($model, $attribute) { return $model->{$attribute} !== $model->getOldAttribute($attribute); }, 'on' => 'update' ], [ ['username', 'email'], 'unique', 'on' => 'create', 'message' => 'El usuario y/o contraseña deben ser únicos.' ],

            ['password', 'required'],
            ['Puesto', 'string', 'max' => 100],
            ['password', 'string', 'min' => 6],
            ['passCompare', 'compare', 'compareAttribute'=>'password', 'skipOnEmpty' => false, 'message'=>"Las contraseñas digitadas deben de coincidir."],
            

            ['Id_Institucion', 'required'],
            [['Id_Institucion'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Instituciones::className(), 'targetAttribute' => ['Id_Institucion' => 'Id_Institucion']],
                    
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],        
        ];
 
        //return array_merge(parent::rules(), $child);
    }

  public function attributeLabels()
    {
        return [
           
            'username' => 'Identificación',
            'Puesto' => 'Puesto',
            'Apellido1' => 'Primer Apellido',
            'Apellido2' => 'Segundo Apellido',
          
            'status' => 'Estado',
            'email' => 'Email',
            'Id_Institucion' => 'Institución',
             'instituciones.Nombre' => 'Institución',
           
        ];
    }
 
   

	
        
         /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstituciones()
    {
        return $this->hasOne(\common\models\Instituciones::className(), ['Id_Institucion' => 'Id_Institucion']);
    }
 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucionList()
	{
    	$Instituciones = \common\models\Instituciones::find()->all();
    	$InstitucionesList = ArrayHelper::map($Instituciones, 'Id_Institucion', 'Nombre');
    	return $InstitucionesList;
	}

	public function getInstitucionName()
	{
    	return $this->Instituciones ? $this->$Instituciones->Instituciones : '- no definido -';
	}
}