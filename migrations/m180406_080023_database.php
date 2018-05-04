<?php

use yii\db\Migration;

/**
 * Class m180406_080023_database
 */
class m180406_080023_database extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //create a table for users, what we can be user or admin
        $this->createTable('users',[
            'id'=> $this->primaryKey(),
            'name' => $this->string(),
            'username' => $this->string(),
            'email' => $this->string(),
            'password' => $this->string(),
            'lastlog' => $this->timestamp()->defaultExpression('now()'),
            'registrationtime' => $this->timestamp()->defaultExpression('now()'),
            'admin' => $this->boolean()->defaultValue('0'),
            'authKey' => $this->char(),
            ]);

        //create a table for tickets
        $this->createTable('tickets',[
            'id' => $this->primaryKey(),
            'title' =>$this->string()->notNull(),
            'priority' =>$this->integer(),
            'user_id' =>$this->integer()->notNull(),
            'admin_id' =>$this->integer(),
            'open' => $this->boolean()->defaultValue('0'),
            'shortDescribe' =>$this->string(),
            'longDescribe' =>$this->string(),
            'problemTheme' =>$this->string(20),
            'ticketmodify' => $this->timestamp()->defaultExpression('now()'),
            ]);

        //create a table for comments
        $this->createTable('comments',[
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'ticket_id' => $this->integer()->notNull(),
            'content' => $this->string(),
            'commenttime' => $this->timestamp()->defaultExpression('now()'),
            'opened' => $this->boolean()->defaultValue('0'),
            ]);

        //create a table for images
        $this->createTable('image',[
            'id' => $this->primaryKey(),
            'fileName' => $this->string(128),
            'tickett_id' => $this->integer(),
        ]);


        //tickett_id
        $this->createIndex(
            'idx-post-tickett_id',
            'image',
            'tickett_id'
        );

        //foreign key tickett_id
        $this->addForeignKey(
            'fk-post-tickett_id',
            'image',
            'tickett_id',
            'tickets',
            'id',
            'CASCADE'
        );



        //ticket_id
        $this->createIndex(
            'idx-post-ticket_id',
            'comments',
            'ticket_id'
        );

        //foreign key ticket_id
        $this->addForeignKey(
          'fk-post-ticket_id',
          'comments',
          'ticket_id',
          'tickets',
          'id',
          'CASCADE'
        );

        //create index for column 'author_id' (from comments)
        $this->createIndex(
          'idx-post-author_id',
          'comments',
          'author_id'
        );

        //add foreign key for table 'users' (from comments)
        $this->addForeignKey(
            'fk-post-author_id',
            'comments',
            'author_id',
            'users',
            'id',
            'CASCADE'
        );

        //create index for column 'user_id'
        $this->createIndex(
            'idx-post-user_id',
            'tickets',
            'user_id'
        );

        //add foreign key for table 'users'
        $this->addForeignKey(
            'fk-post-user_id',
            'tickets',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        //drop
        $this->dropForeignKey(
            'fk-post-tickett_id',
            'image'
        );

        $this->dropIndex(
            'idx-post-tickett_id',
            'image'
        );


        //drop 'comment time'
        $this->dropForeignKey(
            'fk-post-ticket_id',
            'comments'
        );

        $this->dropIndex(
            'idx-post-ticket_id',
            'comments'
        );


        //drops foreign key for table 'users' (from comments)
        $this->dropForeignKey(
            'fk-post-author_id',
            'comments'
        );
        //drop index for column 'author_id'
        $this->dropIndex(
          'idx-post-author_id',
          'comments'
        );

        //drops foreign key for table 'users'
        $this->dropForeignKey(
          'fk-post-user_id',
          'tickets'
        );
        //drops index for column 'user_id'
        $this->dropIndex(
            'idx-post-user_id',
            'tickets'
        );



        //table drops
        $this->dropTable('users');
        $this->dropTable('tickets');
        $this->dropTable('comments');
        $this->dropTable('image');
    }

}
