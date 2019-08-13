<?php

use yii\db\Migration;

/**
 * Class m190813_111949_add_column_foto_na_tabela_pessoa
 */
class m190813_111949_add_column_foto_na_tabela_pessoa extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pessoa', 'foto', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190813_111949_add_column_foto_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190813_111949_add_column_foto_na_tabela_pessoa cannot be reverted.\n";

        return false;
    }
    */
}
