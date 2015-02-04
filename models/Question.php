<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Question".
 *
 * @property integer $id
 * @property string $text
 * @property integer $type
 *
 * @property Result[] $results
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'type'], 'required'],
            [['text'], 'string'],
            [['type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['q_id' => 'id']);
    }
}
