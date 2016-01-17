<?php

use yii\db\Schema;
use yii\db\Migration;

class m160107_110021_create_kscd_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // kscd_categories - Категории
        $this->createTable('{{%kscd_categories}}', [
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
        
        $this->createIndex('kscd_categories_unique_name', '{{%kscd_categories}}', 'name', true);
        $this->createIndex('kscd_categories_unique_slug', '{{%kscd_categories}}', 'slug', true);
        $this->addForeignKey('fk_created_user_kscd_categories', '{{%kscd_categories}}', 'created_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_updated_user_kscd_categories', '{{%kscd_categories}}', 'updated_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

        // kscd_posts - Записи
        $this->createTable('{{%kscd_posts}}', [
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
        
        $this->createIndex('kscd_posts_category_id', '{{%kscd_posts}}', 'category_id', false);
        //$this->createIndex('kscd_posts_category_id_date_gmt', '{{%kscd_posts}}', ['category_id', 'created_date_gmt'], false);
        $this->createIndex('kscd_posts_category_id_created_date', '{{%kscd_posts}}', ['category_id', 'created_date'], false);
        $this->addForeignKey('fk_category_id_kscd_posts', '{{%kscd_posts}}', 'category_id', '{{%kscd_categories}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_created_user_kscd_posts', '{{%kscd_posts}}', 'created_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_updated_user_kscd_posts', '{{%kscd_posts}}', 'updated_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

        // kscd_comments - Комментарии к записям
        $this->createTable('{{%kscd_comments}}', [
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
        
        //$this->createIndex('kscd_comments_approved_date_gmt', '{{%kscd_comments}}', ['approved', 'created_date_gmt'], false);
        $this->createIndex('kscd_comments_approved_created_date', '{{%kscd_comments}}', ['approved', 'created_date'], false);
        $this->createIndex('kscd_comments_author_email', '{{%kscd_comments}}', 'author_email', false);
        //$this->createIndex('kscd_comments_created_date_gmt', '{{%kscd_comments}}', 'created_date_gmt', false);
        $this->createIndex('kscd_comments_created_date', '{{%kscd_comments}}', 'created_date', false);
        $this->createIndex('kscd_comments_parent', '{{%kscd_comments}}', 'parent', false);
        $this->createIndex('kscd_comments_post_id', '{{%kscd_comments}}', 'post_id', false);
        $this->addForeignKey('fk_post_id_kscd_comments', '{{%kscd_comments}}', 'post_id', '{{%kscd_posts}}', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_created_user_kscd_comments', '{{%kscd_comments}}', 'created_user', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

        // kscd_tags - Теги
        $this->createTable('{{%kscd_tags}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(80)->notNull(),
            'frequency' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
        
        $this->createIndex('kscd_tags_unique_name', '{{%kscd_tags}}', 'name', true);
        
    }

    public function down()
    {
        //echo "m160107_110021_create_kscd_tables cannot be reverted.\n";
        //return false;
        
        // Шаг 1 - удаляем таблицы с дочерними записями
        $this->dropTable('{{%kscd_comments}}');
        $this->dropTable('{{%kscd_posts}}');
        
        // Шаг 2 - удаляем таблицы с родительскими записями
        $this->dropTable('{{%kscd_categories}}');
        
        // Шаг 3 - удаляем несвязанные таблицы
        $this->dropTable('{{%kscd_tags}}');
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
