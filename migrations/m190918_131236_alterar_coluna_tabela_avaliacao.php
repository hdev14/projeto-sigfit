<?php

use yii\db\Migration;

/**
 * Class m190918_131236_alterar_coluna_tabela_avaliacao
 */
class m190918_131236_alterar_coluna_tabela_avaliacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('avaliacao', 'data_fim');
        $this->addColumn('avaliacao', 'data_update', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190918_131236_alterar_coluna_tabela_avaliacao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190918_131236_alterar_coluna_tabela_avaliacao cannot be reverted.\n";

        return false;
    }
    */
}
