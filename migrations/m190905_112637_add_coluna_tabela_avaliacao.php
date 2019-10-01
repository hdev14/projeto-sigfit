<?php

use yii\db\Migration;

/**
 * Class m190905_112637_add_coluna_tabela_avaliacao
 */
class m190905_112637_add_coluna_tabela_avaliacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('avaliacao', 'nome', $this->string(45)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190905_112637_add_coluna_tabela_avaliacao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_112637_add_coluna_tabela_avaliacao cannot be reverted.\n";

        return false;
    }
    */
}
