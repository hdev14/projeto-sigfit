<?php

use yii\db\Migration;

/**
 * Class m190808_113455_criar_tabela_restricao
 */
class m190808_113455_criar_tabela_restricao extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('restricao',[
            'id' => $this->primaryKey(),
            'numero_faltas' => $this->integer()->notNull()->defaultValue(3),
            'numero_usuarios' => $this->integer()->notNull()->defaultValue(8),
            'ativado' => $this->boolean()->notNull()->defaultValue(false)
        ]);

        $this->createTable('horario_treino', [
            'id' => $this->primaryKey(),
            'restricao_id' => $this->integer()->notNull(),
            'horario' => $this->time()->notNull()
        ]);

        $this->addForeignKey(
            'fk_horario_treino_restricao',  # fk constraint
            'horario_treino',               # tabela que a constraint pertencerá
            'restricao_id',                 # coluna da constraint
            'restricao',                    # tabela da chave estrangeira
            'id'                            # coluna da chave estrangeira
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190808_113455_criar_tabela_restricao cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190808_113455_criar_tabela_restricao cannot be reverted.\n";

        return false;
    }
    */
}
