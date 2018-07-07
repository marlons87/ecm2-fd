<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$idEvaluacion = 97;
$comentario="";
$this->title = 'Controles a evaluar';

$this->params['breadcrumbs'][] = ['label' => 'Evaluaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<input id="idEvaluacion" type="hidden" value="<?= Html::encode($idevaluacion) ?>">
<input id="idDominio" type="hidden" value="<?= Html::encode($iddominio) ?>" >

<?php
$form = ActiveForm::begin([
            "method" => "post",
        ]);
?>
<?php foreach ($controles as $valc): ?> 

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $valc['Nombre']; ?>
            </h3>
        </div>
        <div class="panel-body">

            <?php
            $valn = $valc['niveles'];

            foreach ($valc['niveles'] as $varNiveles):
                $val = '';
                foreach ($respuestas as $respuesta):

                    if ($varNiveles['Id_Control'] == $respuesta['Id_Control'] && $varNiveles['Id_Nivel'] == $respuesta['Id_Nivel']) {
                        $val = $varNiveles['Id_Nivel'];
                        $comentario = $respuesta['Observaciones'];
                        break;
                    } else {
                        if ($varNiveles['Valor'] == -1 &&  $val = '') {
                            $val = $varNiveles['Id_Nivel'];
                        }
                    }
                endforeach;
                echo Html::radioList($valc['Nombre'] . "radio", $val, [$varNiveles['Id_Nivel'] => $varNiveles['Descripcion']]);

            endforeach;
            ?>

        </div>
        <div class="panel-footer">
            <label>Observaciones:</label>
            <textarea class="txtObservaciones" id="<?= Html::encode($valc['Id_Control']) ?>"  name="txtObservaciones" style="width:100%"><?=(trim($comentario)); ?></textarea>

        </div>

    </div>
<?php endforeach; ?>

<?=
Html::submitButton('submit', ['class' => 'btn btn-success', 'value' => 'my_value', 'onClick' => 'js:sendData()']);


ActiveForm::end();
?>


<script>


    function sendData() {
        var selected = [];
        $('input:checked').each(function () {
            selected.push($(this).attr('value'));
            //alert($(this).attr('value'));
        });

        var formElements = new Array();
        $(".txtObservaciones").each(function () {
            formElements.push($(this).attr('id') + "~" + $(this).val());
            //alert($(this).attr('id')+"~"+$(this).val()) ;
        });

        $.ajax({
            type: "POST",
            url: "<?php echo Yii::$app->getUrlManager()->createUrl('evaluaciones/ajax'); ?>",
            data: {niveles: selected, observaciones: formElements, idEvaluacion: $('#idEvaluacion').val()},
            success: function (niveles) {
                alert(niveles);
            },
            error: function (exception) {
                alert('Hubo error');
            }
        });
    }

    function sendData2() {

        var formElements = new Array();
        $(".txtObservaciones").each(function () {
            formElements.push($(this).val());
            alert($(this).attr('id') + "~" + $(this).val());
        });

    }

</script>
