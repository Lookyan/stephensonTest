<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Тест Стефансона';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Тест Стефансона</h1>

        <p class="lead">Семантический метод диагностики</p>
        <div class="container">
            <div class="col-md-offset-4 col-md-4">
            <?php echo Html::beginForm(Url::toRoute("start/index"), "post", ['class' => 'form-horizontal', 'id' => 'start-test']); ?>
            <div class="form-group">
                <?php echo Html::textInput("fio", '', ['class' => 'form-control',
                                                'id'    => 'fio',
                                                'placeholder' => 'ФИО']);
                ?>
            </div>
            <?php
                echo Html::submitButton('Начать тест', ['class' => 'btn btn-lg btn-success']);
                echo Html::endForm();
            ?>
            </div>
        </div>
    </div>

    <div class="body-content">

        <?php
            echo Html::a("Посмотреть результаты", ['results/index'], ['class' => 'btn btn-primary center-block']);
        ?>

    </div>
</div>
<?php
$this->registerJsFile(
    '/web/js/index.js',
    ['depends' => '\yii\web\JqueryAsset']
);
?>