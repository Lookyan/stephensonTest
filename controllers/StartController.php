<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web;
use app\models\User;
use app\models\Answer;
use app\models\Result;
use app\models\Question;

class StartController extends web\Controller
{

    public function actionIndex()
    {
        $request = Yii::$app->request;
        if($request->isPost) {
            $name = $request->post('fio', false);
            if($name) {
                $user = new User();
                $user->name = $name;
                $user->save();
                $session = new web\Session();
                $session->open();
                $session['id'] = $user->id;
                $session['question'] = 0;
                $session['q_id'] = 0;
                $answers = Answer::find()->all();
                $radios = array();
                foreach($answers as $answer) {
                    $radios[$answer['id']] = $answer['a_text'];
                }
                return $this->render('index', ["answers" => $radios]);
            } else {
                throw new web\NotFoundHttpException;
            }
        } else {
            return $this->redirect(Url::toRoute(['site/index']),302);
        }
    }

    public function actionAjax()
    {
        if (Yii::$app->request->isAjax) {

            $session = new web\Session();
            $session->open();
            if ($session['question'] != 0) { //если поступил ответ
                $result = new Result();
                $result->u_id = $session['id'];
                $result->a_id = Yii::$app->request->post("selection");
                $result->q_id = $session['q_id'];
                $result->save();
            }


            $question = Question::find()->offset($session['question'])->one();
            if($question) {
                $res = array(
                    'status' => 'OK',
                    'statement' => $question['text'],
                );
                $session['question'] = $session['question'] + 1;
                $session['q_id'] = $question['id'];
            } else {
                $res = array(
                    'status' => 'finish',
                );
            }

            Yii::$app->response->format = web\Response::FORMAT_JSON;
            return $res;
        }
    }

    public function actionCompute()
    {
        $session = new web\Session();
        $session->open();
        $userId = $session['id'];
        if(!$userId) {
            return $this->redirect(Url::toRoute(['site/index']),302);
        }
        //получаем суммы и кол-во по каждому критерию и по значимости ответа:
        $positiveResults = Yii::$app->db->createCommand("SELECT q.type AS type, COUNT(r.id), SUM(a.effect) AS sum FROM Result r JOIN Answer a ON r.a_id = a.id JOIN Question q ON r.q_id = q.id WHERE r.u_id = :uid AND a.effect > 0 GROUP BY q.type")->bindValue(':uid', $userId)->queryAll();
        $negativeResults = Yii::$app->db->createCommand("SELECT q.type AS type, COUNT(r.id), ABS(SUM(a.effect)) AS sum FROM Result r JOIN Answer a ON r.a_id = a.id JOIN Question q ON r.q_id = q.id WHERE r.u_id = :uid AND a.effect < 0 GROUP BY q.type")->bindValue(':uid', $userId)->queryAll();
        $tend = array();
        for($i = 1; $i <= Yii::$app->params["tendCount"]; $i++) {
            $tend[$i] = 0;
        }
        foreach($positiveResults as $result) {
            $tend[$result['type']] = $result['sum'];
        }
        foreach($negativeResults as $result) {
            if($result['type'] % 2 == 0) {
                $tend[$result['type'] - 1] += $result['sum'];
            } else {
                $tend[$result['type'] + 1] += $result['sum'];
            }
        }
        //detect tend
        if($tend[1] > $tend[2]) {
            $depend = Yii::$app->params['tendTypeYes'];
        } else if($tend[1] < $tend[2]){
            $depend = Yii::$app->params['tendTypeAnti'];
        } else {
            $depend = Yii::$app->params['tendTypeEqual'];
        }

        if($tend[3] > $tend[4]) {
            $sociability = Yii::$app->params['tendTypeYes'];
        } else if($tend[3] < $tend[4]){
            $sociability = Yii::$app->params['tendTypeAnti'];
        } else {
            $sociability = Yii::$app->params['tendTypeEqual'];
        }

        if($tend[5] > $tend[6]) {
            $struggle = Yii::$app->params['tendTypeYes'];
        } else if($tend[5] < $tend[6]){
            $struggle = Yii::$app->params['tendTypeAnti'];
        } else {
            $struggle = Yii::$app->params['tendTypeEqual'];
        }

        $user = User::findOne($userId);
        $user->depend = $depend;
        $user->sociability = $sociability;
        $user->struggle = $struggle;
        $user->save();
        return $this->render('compute', ["depend" => $depend, "sociability" => $sociability, "struggle" => $struggle]);
    }

}
