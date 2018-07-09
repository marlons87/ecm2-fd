<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;

AppAsset::register($this);

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor ingrese sus credenciales de acceso:</p>

    <div class="row">
        
        
        <div id="divLoading" class="modalLoading">
            <div>
                <p>Cargando</p>
            </div>
        </div>

        <div id="overlay" class="modalDialog">
            <div>
                <a onclick="overlay();" title="Cerrar" class="close">X</a>
                <h3>Autenticación</h3>

                <input id="chkTarjeta" type="radio" name="tipoCertificado" value="CARD" onclick="typeCertificate();" checked><label for="chkTarjeta"><img src="img/tarjeta.png" alt="Tarjeta" />Tarjeta</label>
                <!--<br>-->
               <!-- <input id="chkArchivo" type="radio" name="tipoCertificado" value="FILE" onclick="typeCertificate();"><label for="chkArchivo"><img src="img/folder.png" alt="Archivo" />Archivo</label>-->
                <div id="divFiles">
                    Por favor seleccione el certificado:
                <div id="divCertFiles">
                </div>
                </div>

                <div id="divSmartCard">
                    Por favor seleccione el certificado:
                <div id="divSmartCardCerts">
                </div>
                </div>

                <br>
                <br>
                <label>Pin:</label>
                <input id="pin" type="password" onkeypress="Javascript: if (event.which == 13 || event.keyCode == 13) getDN();" />
                <button class="btn btn-primary" onclick="getDN();">Validar</button>
                <button class="btn btn-primary" onclick="overlay();">Cerrar</button>
            </div>
        </div>
        
        
        <div class="col-lg-5">            
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="form-group">
                    <?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-success', 'value' => 'my_value', 'onClick' => 'verificarConexion();']);
                        ?>                    
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
