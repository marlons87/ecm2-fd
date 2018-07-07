<?php

namespace frontend\models;
use Yii;
use yii\base\model;

class EvaluacionForm extends model
{
	public $IdDominio;
        public $IdControl;
        public $NombreControl;
        public $IdNivel;
        public $NombreNivel;
        public $IdRespuesta;        
        

	public function rules()
	{
		return[
			[['IdDominio', 'IdControl', 'IdNivel', 'IdRespuesta'], 'integer'],
		];
	}

	public function attributeLabels()
	{
		return [
                    'IdDominio'=> 'IdDominio',
                    'IdControl'=> 'IdControl',
                    'NombreControl'=> 'NombreControl',
                    'IdNivel'=> 'IdNivel',
                    'NombreNivel'=> 'NombreNivel',
                    'IdRespuesta'=> 'IdRespuesta',
		];
	}
}