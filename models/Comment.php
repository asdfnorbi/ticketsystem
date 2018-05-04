<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $author_id
 * @property int $ticket_id
 * @property string $content
 * @property string $commenttime
 *
 * @property Ticket $ticket
 * @property User $author
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['commenttime', 'safe'],
            [['author_id', 'ticket_id'], 'required'],
            [['author_id', 'ticket_id'], 'default', 'value' => null],
            [['author_id', 'ticket_id'], 'integer'],
            [['content'], 'string', 'max' => 255],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::className(), 'targetAttribute' => ['ticket_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Kommentelő',
            'ticket_id' => 'Ehhez a tickethez',
            'content' => 'Komment tartalma',
            'commenttime' => 'Dátum',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }


   /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getOpen(){
        return $this->ticket->getOpened();
    }

}
