<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $answers array */
?>
<h1>Утверждение №<span id="q_number">0</span></h1>

<p>
    <?php
    echo Html::tag("div", "", ['class' => 'well', 'id' => 'statement']);

    echo Html::radioList("selection", array_keys($answers)[0], $answers, ['item' => function ($index, $label, $name, $checked, $value) {
        return '<div class="radio"><label>' .
        Html::radio($name, $checked, ['value' => $value]) . $label . '</label></div>';
    }]);
    echo Html::a("Следующее утверждение", ['start/ajax'], ["class" => "btn btn-primary", "id" => "next", "data-compute" => Url::to(['start/compute'])]);
    ?>

</p>
<?php
$this->registerJsFile(
    '/web/js/start.js',
    ['depends' => '\yii\web\JqueryAsset']
);
?>