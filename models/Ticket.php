<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property string $title
 * @property int $priority
 * @property int $user_id
 * @property int $admin_id
 * @property bool $open
 * @property string $shortDescribe
 * @property string $longDescribe
 * @property string $problemTheme
 * @property string ticketmodify
 *
 * @property Comments[] $comments
 * @property Users $user
 * @property Users $admin
 * @var $dataProvider yii\data\ActiveDataProvider
 */
class Ticket extends \yii\db\ActiveRecord
{
    const PRIORITY_NORMAL = 0;
    const PRIORITY_URGENT = 1;
    const PRIORITY_CRITICAL = 2;
    const STATUS_OPEN = 0;
    const STATUS_CLOSED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'user_id', 'admin_id'], 'required'],
            [['priority', 'user_id'], 'default', 'value' => null],
            [['priority', 'user_id', 'admin_id'], 'integer'],
            [['open'], 'boolean'],
            [['title', 'shortDescribe', 'longDescribe'], 'string', 'max' => 255],
            [['problemTheme'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Címe',
            'priority' => 'Prioritás',
            'user_id' => 'Létrehozta',
            'admin_id' => 'Adminja',
            'shortDescribe' => 'Rövid leírás',
            'longDescribe' => 'Hosszú leírás',
            'problemTheme' => 'Probléma témája',
            'open' => 'Státusz',
            'ticketmodify' => 'Utolsó változtatások',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasMany(Comment::className(), ['ticket_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getOpened(){
        return $this->open=0;
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getAdmin()
    {
        return $this->hasOne(User::className(), ['id' => 'admin_id']);
    }

    public static function getPriorityString($ticketStatus)
    {
        if (!isset($ticketStatus)) {
            return null;
        }
        $priorityArray = self::getPriorityArray();
        return $priorityArray[$ticketStatus];
    }

    public static function getPriorityArray(){
        $priority = [
            Ticket::PRIORITY_NORMAL =>"Normal",
            Ticket::PRIORITY_URGENT => "Urgent",
            Ticket::PRIORITY_CRITICAL => "Critical",
         ];

        return $priority;
    }

    public function getTicketuser(){
        return $this->user_id;
    }
}
