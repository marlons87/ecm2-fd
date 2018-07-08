<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "niveles".
 *
 * @property int $Id_Nivel
 * @property int $Valor
 * @property string $Descripcion
 * @property int $Id_Control
 *
 * @property Controles $control
 * @property Respuestas[] $respuestas
 */
class Niveles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'niveles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Valor'], 'required','message' => 'Complete el valor para del nivel.'],
            [['Descripcion'], 'required','message' => 'Complete la descripción.'],
            [['Id_Control'], 'required','message' => 'Seleccione el control al cual pertenece el nivel.'],
            [['Valor', 'Id_Control'], 'integer'],
            [['Descripcion'], 'string', 'max' => 250],
            [['Id_Control'], 'exist', 'skipOnError' => true, 'targetClass' => Controles::className(), 'targetAttribute' => ['Id_Control' => 'Id_Control']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id_Nivel' => 'ID',
            'Valor' => 'Valor',
            'Descripcion' => 'Descripción',
            'Id_Control' => 'Control',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestas()
    {
        return $this->hasMany(Respuestas::className(), ['Id_Nivel' => 'Id_Nivel']);
    }

    /**
     * @inheritdoc
     * @return NivelesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NivelesQuery(get_called_class());
    }
    
    
      public function getControl()
    {
        return $this->hasOne(Controles::className(), ['Id_Control' => 'Id_Control']);
    }
    
         public function getControlList()
	{
    	$Control = Controles::find()->all();
    	$ControlList = ArrayHelper::map($Control, 'Id_Control', 'Nombre');
    	return $ControlList;
	}

	public function getControlName()
	{
    	return $this->control ? $this->$control->control : '- no definido -';
	}
    
}
