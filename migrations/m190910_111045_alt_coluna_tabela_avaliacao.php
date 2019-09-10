<?php

use yii\db\Migration;

/**
 * Class m190910_111045_alt_coluna_tabela_avaliacao
 */
class m190910_111045_alt_coluna_tabela_avaliacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('avaliacao','idade', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190910_111045_alt_coluna_tabela_avaliacao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190910_111045_alt_coluna_tabela_avaliacao cannot be reverted.\n";

        return false;
    }
    */
}
