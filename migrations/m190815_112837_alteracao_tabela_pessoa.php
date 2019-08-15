<?php

use yii\db\Migration;

/**
 * Class m190815_112837_alteracao_tabela_pessoa
 */
class m190815_112837_alteracao_tabela_pessoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('pessoa', 'matricula', $this->string(45)->notNull
        ()->unique());

        $this->addColumn('pessoa', 'servidor', $this->boolean()->defaultValue
        (false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190815_112837_alteracao_tabela_pessoa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190815_112837_alteracao_tabela_pessoa cannot be reverted.\n";

        return false;
    }
    */
}
