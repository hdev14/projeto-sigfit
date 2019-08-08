<?php

use yii\db\Migration;

/**
 * Class m190619_125030_criar_tabelas_sigfit
 */
class m190619_125030_criar_tabelas_sigfit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // COMENTAR AS PRIMARY KEYS
        
        # Tabela Pessoa
        $this->createTable('pessoa',[
            'id' => $this->primaryKey(),
            'matricula' => $this->string(45)->notNull(),
            'nome' => $this->string(45)->notNull(),
            'email' => $this->string(50),
            'curso' => $this->string(50),
            'periodo_curso' => $this->integer(),
            'horario_treino' => "ENUM('nenhum','7h às 8h', '8h às 9h', '9h às 10h', '10h às 11h') DEFAULT 'nenhum'",
            'problema_saude' => $this->text(),
            'faltas' => $this->integer(),
            'espera' => $this->boolean(),
            'telefone' => $this->string(20)
        ]);

        # Tabela de auto-relacionamento UsuarioInstrutor
        $this->createTable('usuario_instrutor', [
            'usuario_id' => $this->integer()->notNull(),
            'instrutor_id' => $this->integer()->notNull()
        ]);

        # Definindo chave primária composta
        $this->addPrimaryKey(
            'usuario_instrutor_pk',         # pk constraint
            'usuario_instrutor',            # tabela da chave primária
            ['usuario_id', 'instrutor_id']  # coluna(s) da chave primária
        );

        # Chaves estrangeiras da tabela Pessoa
        $this->addForeignKey(
            'usuario_instrutor_usuario',    # fk constraint
            'usuario_instrutor',            # tabela que a constraint pertencerá
            'usuario_id',                   # coluna da constraint
            'pessoa',                       # tabela da chave estrangeira
            'id',                           # coluna da chave estrangeira
            'NO ACTION',                    # ON DELETE
            'NO ACTION'                     # ON UPDATE
        );

        $this->addForeignKey(
            'usuario_instrutor_instrutor',  # fk constraint
            'usuario_instrutor',            # tabela que a constraint pertencerá
            'instrutor_id',                 # coluna da constraint
            'pessoa',                       # tabela da chave estrangeira
            'id',                           # coluna da chave estrangeira
            'NO ACTION',                    # ON DELETE
            'NO ACTION'                     # ON UPDATE
        );

        /* -------------------------------------------------- */

        # Tabela Avaliação.
        $this->createTable('avaliacao',[
            'id' => $this->primaryKey(),
            'pessoa_id' => $this->integer()->notNull(),
            'data' => $this->date()->notNull(),
            'altura' => $this->integer()
        ]);

        # Chave estrangeira da tabela Pessoa
        $this->addForeignKey(
            'fk_avaliacao_pessoa',  # fk constraint
            'avaliacao',            # tabela que a constraint pertencerá
            'pessoa_id',            # coluna da constraint
            'pessoa',               # tabela da chave estrangeira
            'id'                    # coluna da chave estrangeira
        );

        /* -------------------------------------------------- */

        # Tabela Frequência
        $this->createTable('frequencia', [
            'id' => $this->primaryKey(),
            'pessoa_id' => $this->integer()->notNull(),
            'data' => $this->date()->notNull(),
            'horario_inicio' => $this->time()->notNull(),
            'horario_final' => $this->time(),
        ]);

        # Chave estrangeira da tabela Pessoa
        $this->addForeignKey(
            'fk_frequencia_pessoa',     # fk constraint
            'frequencia',               # tabela que a constraint pertencerá
            'pessoa_id',                # coluna da constraint
            'pessoa',                   # tabela da chave estrangeira
            'id'                        # coluna da chave estrangeira
        );

        /* -------------------------------------------------- */

        # Tabela Peso
        $this->createTable('peso', [
            'id' => $this->primaryKey(),
            'avaliacao_id' => $this->integer()->notNull(),
            'valor' => $this->float()->notNull(),
        ]);

        # Chave estrangeira da tabela Avaliacao
        $this->addForeignKey(
            'fk_peso_avaliacao',    # fk constraint
            'peso',                 # tabela que a constraint pertencerá
            'avaliacao_id',         # coluna da constraint
            'avaliacao',            # tabela da chave estrangeira
            'id'                    # coluna da chave estrangeira
        );

        /* -------------------------------------------------- */

        # Tabela IMC
        $this->createTable('imc', [
            'id' => $this->primaryKey(),
            'avaliacao_id' => $this->integer()->notNull(),
            'valor' => $this->float()->notNull(),
        ]);

        # Chave estrangeira da tabela Avaliacao
        $this->addForeignKey(
            'fk_imc_avaliacao',     # fk constraint
            'imc',                  # tabela que a constraint pertencerá
            'avaliacao_id',         # coluna da constraint
            'avaliacao',            # tabela da chave estrangeira
            'id'                    # coluna da chave estrangeira
        );

        /* -------------------------------------------------- */

        # Tabela PercentualGordura
        $this->createTable('percentual_gordura', [
            'id' => $this->primaryKey(),
            'avaliacao_id' => $this->integer()->notNull(),
            'valor' => $this->float()->notNull(),
        ]);

        # Chave estrangeira da tabela Avaliacao
        $this->addForeignKey(
            'fk_percentual_gordura_avaliacao',  # fk constraint
            'percentual_gordura',               # tabela que a constraint pertencerá
            'avaliacao_id',                     # coluna da constraint
            'avaliacao',                        # tabela da chave estrangeira
            'id'                                # coluna da chave estrangeira
        );

        /* -------------------------------------------------- */

        # Tabela Treino
        $this->createTable('treino',[
            'id' => $this->primaryKey(),
            'dia' => "ENUM('segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira') NOT NULL",
            'generico' => $this->tinyInteger()
        ]);

        # Tabela de relacionamento PessoaTreino
        $this->createTable('pessoa_treino', [
            'treino_id' => $this->integer()->notNull(),
            'pessoa_id' => $this->integer()->notNull()
        ]);

        # Definindo chave primária composta
        $this->addPrimaryKey(
            'pessoa_treino_pk',         # pk constraint
            'pessoa_treino',            # tabela da chave primária
            ['treino_id', 'pessoa_id']  # coluna(s) da chave primária
        );

        # Chaves estrangeiras das tabelas Pessoa e Treino
        $this->addForeignKey(
            'fk_pessoa_treino_treino',  # fk constraint
            'pessoa_treino',            # tabela que a constraint pertencerá
            'treino_id',                # coluna da constraint
            'treino',                   # tabela da chave estrangeira
            'id',                       # coluna da chave estrangeira
            'NO ACTION',                # ON DELETE
            'NO ACTION'                 # ON UPDATE
        );
        $this->addForeignKey(
            'fk_pessoa_treino_pessoa',  # fk constraint
            'pessoa_treino',            # tabela que a constraint pertencerá
            'pessoa_id',                # coluna da constraint
            'pessoa',                   # tabela da chave estrangeira
            'id',                       # coluna da chave estrangeira
            'NO ACTION',                # ON DELETE
            'NO ACTION'                 # ON UPDATE
        );

        /* -------------------------------------------------- */

        # Tabela Equipamento
        $this->createTable('equipamento', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(45)->notNull(),
            'descricao' => $this->string(200),
            'imagem' => $this->text(),
            'defeito' => $this->tinyInteger(),
        ]);

        /* -------------------------------------------------- */

        # Tabela Exercício
        $this->createTable('exercicio', [
            'id' => $this->primaryKey(),
            'equipamento_id' => $this->integer(),                   # Chave estrangeira opcional
            'nome' => $this->string(45)->notNull(),
            'descricao' => $this->string(200),
            'tipo' => "ENUM('aerobico', 'anaerobico') NOT NULL",
        ]);

        # Chave estrangeira da tabela Equipamento
        $this->addForeignKey(
            'fk_exercicio_equipamento',     # fk constraint
            'exercicio',                    # tabela que a constraint pertencerá
            'equipamento_id',               # coluna da constraint
            'equipamento',                  # tabela da chave estrangeira
            'id'                            # coluna da chave estrangeira
        );

        # Tabela de relacionamento TreinoExercicio
        $this->createTable('treino_exercicio', [
            'treino_id' => $this->integer()->notNull(),
            'exercicio_id' => $this->integer()->notNull(),
            'numero_repeticao' => "ENUM('3x8', '3x10', '3x12') NOT NULL"
        ]);

        # Definindo chave primária composta
        $this->addPrimaryKey(
            'treino_exercicio_pk',          # pk constraint
            'treino_exercicio',             # tabela da chave primária
            ['treino_id', 'exercicio_id']   # coluna(s) da chave primária
        );

        # Chaves estrangeiras das tabelas Treino e Exercicio
        $this->addForeignKey(
            'fk_treino_exercicio_treino',   # fk constraint
            'treino_exercicio',             # tabela que a constraint pertencerá
            'treino_id',                    # coluna da constraint
            'treino',                       # tabela da chave estrangeira
            'id',                           # coluna da chave estrangeira
            'NO ACTION',                    # ON DELETE
            'NO ACTION'                     # ON UPDATE
        );
        $this->addForeignKey(
            'fk_treino_exercicio_exercicio',    # fk constraint
            'treino_exercicio',                 # tabela que a constraint pertencerá
            'exercicio_id',                     # coluna da constraint
            'exercicio',                        # tabela da chave estrangeira
            'id',                               # coluna da chave estrangeira
            'NO ACTION',                        # ON DELETE
            'NO ACTION'                         # ON UPDATE
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190619_125030_criar_tabelas_sigfit cannot be reverted.\n";
        
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190619_125030_criar_tabelas_sigfit cannot be reverted.\n";

        return false;
    }
    */
}
