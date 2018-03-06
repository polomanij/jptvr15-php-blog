<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180305_150028_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'blocked' => $this->boolean()->defaultValue(1)
        ]);
        
        $this->createIndex(
                'index-comment-user_id',
                'comment',
                'user_id'
        );
        
        $this->addForeignKey('fk-comment-user_id',
                'comment',
                'user_id',
                'user',
                'id',
                'CASCADE'
        );
        
        $this->createIndex(
                'index-comment-article_id',
                'comment',
                'article_id'
        );
        
        $this->addForeignKey('fk-comment-article_id',
                'comment',
                'article_id',
                'article',
                'id',
                'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comment');
    }
}
