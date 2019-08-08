<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_instrutor".
 *
 * @property int $usuario_id
 * @property int $instrutor_id
 *
 * @property Pessoa $instrutor
 * @property Pessoa $usuario
 */
class UsuarioInstrutor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario_instrutor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'instrutor_id'], 'required'],
            [['usuario_id', 'instrutor_id'], 'integer'],
            [['usuario_id', 'instrutor_id'], 'unique', 'targetAttribute' => ['usuario_id', 'instrutor_id']],
            [['instrutor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['instrutor_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pessoa::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'instrutor_id' => Yii::t('app', 'Instrutor ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstrutor()
    {
        return $this->hasOne(Pessoa::className(), ['id' => 'instrutor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Pessoa::className(), ['id' => 'usuario_id']);
    }
}
