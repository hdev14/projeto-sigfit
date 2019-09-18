<?php

use yii\db\Migration;

/**
 * Class m190918_130740_add_colunas_tabelas_peso_pdg_imc
 */
class m190918_130740_add_colunas_tabelas_peso_pdg_imc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('peso', 'data', $this->date());
        $this->addColumn('imc', 'data', $this->date());
        $this->addColumn('percentual_gordura', 'data', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190918_130740_add_colunas_tabelas_peso_pdg_imc cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190918_130740_add_colunas_tabelas_peso_pdg_imc cannot be reverted.\n";

        return false;
    }
    */
}
