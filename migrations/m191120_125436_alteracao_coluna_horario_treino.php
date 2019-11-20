<?php

use yii\db\Migration;

/**
 * Class m191120_125436_alteracao_coluna_horario_treino
 */
class m191120_125436_alteracao_coluna_horario_treino extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $enum = <<<ENUM
            ENUM (
                'nenhum', 
                '7h às 8h', 
                '8h às 9h', 
                '9h às 10h', 
                '10h às 11h', 
                '13h às 14h', 
                '14h às 15h', 
                '15h às 16h', 
                '16h às 17h', 
                '17h às 18h', 
                '18h às 19h'
                ) DEFAULT 'nenhum';
ENUM;

        $this->alterColumn(
            "pessoa",
            "horario_treino",
            $enum
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m191120_125436_alteracao_coluna_horario_treino cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191120_125436_alteracao_coluna_horario_treino cannot be reverted.\n";

        return false;
    }
    */
}
