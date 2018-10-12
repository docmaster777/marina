<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m180430_070926_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'filePath' => $this->string(400),
            'itemId' => $this->integer(20),
            'isMain' => $this->integer(1),
            'modelName' => $this->string(150),
            'urlAlias' => $this->string(400),
            'name' => $this->string(80),
            'sort' => $this->integer(),
            'idImage' => $this->integer(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('image');
    }
}
