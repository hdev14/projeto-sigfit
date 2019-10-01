<?php

use yii\db\Migration;

/**
 * Class m190905_120621_add_coluna_sexo_na_tabela_pessoa
 */
class m190905_120621_add_coluna_sexo_na_tabela_pessoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pessoa', 'sexo', "ENUM ('masculino', 'feminino')");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190905_120621_add_coluna_sexo_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190905_120621_add_coluna_sexo_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }
    */
}
