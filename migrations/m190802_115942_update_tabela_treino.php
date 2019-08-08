<?php

use yii\db\Migration;

/**
 * Class m190802_115942_update_tabela_treino
 */
class m190802_115942_update_tabela_treino extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('treino', 'titulo',
            $this->string(45)->notNull());
        $this->addColumn('treino', 'genero',
            $this->char(1)->notNull());
        $this->addColumn('treino', 'nivel',
            "ENUM('iniciante', 'intermediario', 'avançado') NOT NULL DEFAULT 'iniciante' ");

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190802_115942_update_tabela_treino cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190802_115942_update_tabela_treino cannot be reverted.\n";

        return false;
    }
    */
}
