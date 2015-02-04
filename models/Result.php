<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Result".
 *
 * @property integer $id
 * @property integer $u_id
 * @property integer $q_id
 * @property integer $a_id
 *
 * @property User $u
 * @property Question $q
 * @property Answer $a
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'q_id', 'a_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'u_id' => 'U ID',
            'q_id' => 'Q ID',
            'a_id' => 'A ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id' => 'u_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQ()
    {
        return $this->hasOne(Question::className(), ['id' => 'q_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getA()
    {
        return $this->hasOne(Answer::className(), ['id' => 'a_id']);
    }
}
