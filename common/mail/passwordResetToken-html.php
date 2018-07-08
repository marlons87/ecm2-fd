<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

//$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hola estimado <?= Html::encode($user->username) ?>,</p>

    <p>Diríjase al siguiente Link para reestablecer su contraseña de usuario:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
