<?php

use yii\db\Migration;

/**
 * Class m190910_113409_add_coluna_titulo_tabela_avaliacao
 */
class m190910_113409_add_coluna_titulo_tabela_avaliacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('avaliacao', 'nome');
        $this->addColumn('avaliacao', 'titulo', $this->string(45)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190910_113409_add_coluna_titulo_tabela_avaliacao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190910_113409_add_coluna_titulo_tabela_avaliacao cannot be reverted.\n";

        return false;
    }
    */
}
