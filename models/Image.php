<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $fileName
 * @property int $tickett_id
 *
 * @property Ticket $tickett
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tickett_id'], 'default', 'value' => null],
            [['tickett_id'], 'integer'],
            [['fileName'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['tickett_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['tickett_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fileName' => 'Fénykép',
            'tickett_id' => 'Ticket',
        ];
    }

    /**
     * upload function
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->fileName->saveAs('uploads/' . $this->fileName->baseName . '.' . $this->fileName->extension);
            return true;
        } else {
            return false;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickett()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'tickett_id']);
    }
}
