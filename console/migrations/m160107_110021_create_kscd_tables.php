<?php

use yii\db\Schema;
use yii\db\Migration;

class m160107_110021_create_ksk_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // ksk_categories - Категории
        $this->createTable('{{%ksk_categories}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(200)->notNull()->defaultValue(''),
            'slug' => $this->string(200)->notNull()->defaultValue(''),
            'status' => $this->string(20)->notNull()->defaultValue('publish'),
            'created_date' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            //'created_date_gmt' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_user' => $this->integer()->notNull()->defaultValue(0),
            'updated_date' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            //'updated_date_gmt' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'updated_user' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        
        $this->createIndex('ksk_categories_unique_name', '{{%ksk_categories}}', 'name', true);
        $this->createIndex('ksk_categories_unique_slug', '{{%ksk_categories}}', 'slug', true);
        $this->addForeignKey('fk_created_user_ksk_categories', '{{%ksk_categories}}', 'created_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_updated_user_ksk_categories', '{{%ksk_categories}}', 'updated_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

        // ksk_posts - Записи
        $this->createTable('{{%ksk_posts}}', [
            'id' => $this->bigPrimaryKey(),
            'category_id' => $this->bigInteger()->notNull(),
            'title' => $this->string(65535)->notNull(),
            'content' => $this->string(4294967295)->notNull(),
            'tags' => $this->text()->notNull()->defaultValue(''),
            'status' => $this->string(20)->notNull()->defaultValue('publish'),
            'comment_status' => $this->string(20)->notNull()->defaultValue('open'),
            'comment_count' => $this->bigInteger()->notNull()->defaultValue(0),
            'created_date' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            //'created_date_gmt' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_user' => $this->integer()->notNull()->defaultValue(0),
            'updated_date' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            //'updated_date_gmt' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'updated_user' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        
        $this->createIndex('ksk_posts_category_id', '{{%ksk_posts}}', 'category_id', false);
        //$this->createIndex('ksk_posts_category_id_date_gmt', '{{%ksk_posts}}', ['category_id', 'created_date_gmt'], false);
        $this->createIndex('ksk_posts_category_id_created_date', '{{%ksk_posts}}', ['category_id', 'created_date'], false);
        $this->addForeignKey('fk_category_id_ksk_posts', '{{%ksk_posts}}', 'category_id', '{{%ksk_categories}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_created_user_ksk_posts', '{{%ksk_posts}}', 'created_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_updated_user_ksk_posts', '{{%ksk_posts}}', 'updated_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

        // ksk_comments - Комментарии к записям
        $this->createTable('{{%ksk_comments}}', [
            'id' => $this->bigPrimaryKey(),
            'post_id' => $this->bigInteger()->notNull(),
            'author' => $this->string()->notNull(),
            'author_email' => $this->string(100)->notNull()->defaultValue(''),
            'author_url' => $this->string(200)->notNull()->defaultValue(''),
            'author_ip' => $this->string(100)->notNull()->defaultValue(''),
            'agent' => $this->string(255)->notNull()->defaultValue(''),
            'content' => $this->string(4294967295)->notNull(),
            'karma' => $this->integer()->notNull()->defaultValue(0),
            'approved' => $this->string(20)->notNull()->defaultValue('1'),
            'parent' => $this->bigInteger()->notNull()->defaultValue(0),
            'created_date' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            //'created_date_gmt' => $this->dateTime()->notNull()->defaultValue('0000-00-00 00:00:00'),
            'created_user' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        
        //$this->createIndex('ksk_comments_approved_date_gmt', '{{%ksk_comments}}', ['approved', 'created_date_gmt'], false);
        $this->createIndex('ksk_comments_approved_created_date', '{{%ksk_comments}}', ['approved', 'created_date'], false);
        $this->createIndex('ksk_comments_author_email', '{{%ksk_comments}}', 'author_email', false);
        //$this->createIndex('ksk_comments_created_date_gmt', '{{%ksk_comments}}', 'created_date_gmt', false);
        $this->createIndex('ksk_comments_created_date', '{{%ksk_comments}}', 'created_date', false);
        $this->createIndex('ksk_comments_parent', '{{%ksk_comments}}', 'parent', false);
        $this->createIndex('ksk_comments_post_id', '{{%ksk_comments}}', 'post_id', false);
        $this->addForeignKey('fk_post_id_ksk_comments', '{{%ksk_comments}}', 'post_id', '{{%ksk_posts}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_created_user_ksk_comments', '{{%ksk_comments}}', 'created_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

        // ksk_tags - Теги
        $this->createTable('{{%ksk_tags}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(80)->notNull(),
            'frequency' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        
        $this->createIndex('ksk_tags_unique_name', '{{%ksk_tags}}', 'name', true);
        
    }

    public function down()
    {
        //echo "m160107_110021_create_ksk_tables cannot be reverted.\n";
        //return false;
        
        // Шаг 1 - удаляем таблицы с дочерними записями
        $this->dropTable('{{%ksk_comments}}');
        $this->dropTable('{{%ksk_posts}}');
        
        // Шаг 2 - удаляем таблицы с родительскими записями
        $this->dropTable('{{%ksk_categories}}');
        
        // Шаг 3 - удаляем несвязанные таблицы
        $this->dropTable('{{%ksk_tags}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
