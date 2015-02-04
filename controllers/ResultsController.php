<?php

namespace app\controllers;

use app\models\User;

class ResultsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $users = User::find()->where('depend is not null')->all();
        return $this->render('index', ['users' => $users]);
    }

}
