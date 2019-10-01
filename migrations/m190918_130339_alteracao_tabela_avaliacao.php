<?php

use yii\db\Migration;

/**
 * Class m190918_130339_alteracao_tabela_avaliacao
 */
class m190918_130339_alteracao_tabela_avaliacao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('avaliacao', 'data');
        $this->addColumn('avaliacao', 'data_inicio', $this->date());
        $this->addColumn('avaliacao', 'data_fim', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190918_130339_alteracao_tabela_avaliacao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190918_130339_alteracao_tabela_avaliacao cannot be reverted.\n";

        return false;
    }
    */
}
