<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m180305_145910_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'desc' => $this->text(),
            'text' => $this->text(),
            'image' => $this->string(),
            'date' => $this->timestamp(),
            'viewed' => $this->integer(),
            'category_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article');
    }
}
