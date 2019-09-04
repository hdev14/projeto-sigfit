<?php

use yii\db\Migration;

/**
 * Class m190819_125728_add_coluna_token_na_tabela_pessoa
 */
class m190819_125728_add_coluna_token_na_tabela_pessoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->addColumn('pessoa', 'token', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190819_125728_add_coluna_token_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190819_125728_add_coluna_token_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }
    */
}
