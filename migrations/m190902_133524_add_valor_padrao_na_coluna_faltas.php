<?php

use yii\db\Migration;

/**
 * Class m190902_133524_add_valor_padrao_na_coluna_faltas
 */
class m190902_133524_add_valor_padrao_na_coluna_faltas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('pessoa', 'faltas', $this->integer()->defaultValue
        (0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190902_133524_add_valor_padrao_na_coluna_faltas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190902_133524_add_valor_padrao_na_coluna_faltas cannot be reverted.\n";

        return false;
    }
    */
}
