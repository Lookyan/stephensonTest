<?php
/* @var $this yii\web\View */
/* @var $depend Integer */
/* @var $sociability Integer */
/* @var $struggle Integer */
use yii\helpers\Html;
?>
<h2>Тест пройден!</h2>
<p>
    <span>Ваши результаты:</span>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Тенденция</th>
            <th>Результат</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Зависимость</td>
            <td>
                <?php
                    if($depend == Yii::$app->params["tendTypeYes"]) {
                        echo "Да";
                    } else if($depend == Yii::$app->params["tendTypeAnti"]) {
                        echo "Нет";
                    } else {
                        echo "Не определено";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Общительность</td>
            <td>
                <?php
                if($sociability == Yii::$app->params["tendTypeYes"]) {
                    echo "Да";
                } else if($sociability == Yii::$app->params["tendTypeAnti"]) {
                    echo "Нет";
                } else {
                    echo "Не определено";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Терпимость к борьбе</td>
            <td>
                <?php
                if($struggle == Yii::$app->params["tendTypeYes"]) {
                    echo "Да";
                } else if($struggle == Yii::$app->params["tendTypeAnti"]) {
                    echo "Нет";
                } else {
                    echo "Не определено";
                }
                ?>
            </td>
        </tr>
        </tbody>
        </table>

<?php
    echo Html::a("Посмотреть все результаты", ['results/index'], ['class' => 'btn btn-primary center-block']);
?>
</p>