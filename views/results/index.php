<?php
/* @var $this yii\web\View */
/* @var $users array */
?>
<h1>Результаты</h1>

<p>
<table class="table table-bordered">
    <thead>
    <tr>
        <th class="top-head" rowspan="2">ФИО</th>
        <th colspan="3">Результат</th>
    </tr>
    <tr><th>Зависимость</th><th>Общительность</th><th>Принятие борьбы</th></tr>
    </thead>
    <tbody>
    <?php
        foreach($users as $user) {
    ?>
        <tr>
            <td><?=$user['name'] ?></td>
            <td>
                <?php
                if($user['depend'] == Yii::$app->params["tendTypeYes"]) {
                    echo "Да";
                } else if($user['depend'] == Yii::$app->params["tendTypeAnti"]) {
                    echo "Нет";
                } else {
                    echo "Не определено";
                }
                ?>
            </td>
            <td>
                <?php
                if($user['sociability'] == Yii::$app->params["tendTypeYes"]) {
                    echo "Да";
                } else if($user['sociability'] == Yii::$app->params["tendTypeAnti"]) {
                    echo "Нет";
                } else {
                    echo "Не определено";
                }
                ?>
            </td>
            <td>
                <?php
                if($user['struggle'] == Yii::$app->params["tendTypeYes"]) {
                    echo "Да";
                } else if($user['struggle'] == Yii::$app->params["tendTypeAnti"]) {
                    echo "Нет";
                } else {
                    echo "Не определено";
                }
                ?>
            </td>
        </tr>
    <?php
        }
    ?>
    </tbody>
</table>
</p>
