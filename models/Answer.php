<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Answer".
 *
 * @property integer $id
 * @property string $a_text
 * @property integer $effect
 *
 * @property Result[] $results
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['a_text', 'effect'], 'required'],
            [['effect'], 'integer'],
            [['a_text'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'a_text' => 'A Text',
            'effect' => 'Effect',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['a_id' => 'id']);
    }
}
