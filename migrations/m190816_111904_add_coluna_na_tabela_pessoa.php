<?php

use yii\db\Migration;

/**
 * Class m190816_111904_add_coluna_na_tabela_pessoa
 */
class m190816_111904_add_coluna_na_tabela_pessoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pessoa', 'servidor', $this->boolean()->defaultValue
        (false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190816_111904_add_coluna_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190816_111904_add_coluna_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }
    */
}
