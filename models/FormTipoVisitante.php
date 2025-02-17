<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "form_tipo_visitante".
 *
 * @property float $form_tvid
 * @property string $form_tvnombre
 * @property float $form_tvtarifa
 * @property string|null $form_tvdescripcion
 * @property int|null $form_tvorden
 * @property int|null $form_tvestado
 */
class FormTipoVisitante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_tipo_visitante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_tvid', 'form_tvnombre', 'form_tvtarifa'], 'required'],
            [['form_tvid', 'form_tvtarifa'], 'number'],
            [['form_tvorden', 'form_tvestado'], 'default', 'value' => null],
            [['form_tvorden', 'form_tvestado'], 'integer'],
            [['form_tvnombre'], 'string', 'max' => 100],
            [['form_tvdescripcion'], 'string', 'max' => 200],
            [['form_tvid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'form_tvid' => 'Form Tvid',
            'form_tvnombre' => 'Form Tvnombre',
            'form_tvtarifa' => 'Form Tvtarifa',
            'form_tvdescripcion' => 'Form Tvdescripcion',
            'form_tvorden' => 'Form Tvorden',
            'form_tvestado' => 'Form Tvestado',
        ];
    }
}