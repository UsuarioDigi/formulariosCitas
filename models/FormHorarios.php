<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "form_horarios".
 *
 * @property float $form_hid
 * @property string $form_hnombre
 * @property string $form_hdescripcion
 * @property int|null $form_horden
 * @property int|null $form_hestado
 *
 * @property FormDatosCitas[] $formDatosCitas
 */
class FormHorarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_horarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_hid', 'form_hnombre', 'form_hdescripcion'], 'required'],
            [['form_hid'], 'number'],
            [['form_horden', 'form_hestado'], 'default', 'value' => null],
            [['form_horden', 'form_hestado'], 'integer'],
            [['form_hnombre'], 'string', 'max' => 100],
            [['form_hdescripcion'], 'string', 'max' => 200],
            [['form_hid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'form_hid' => 'Form Hid',
            'form_hnombre' => 'Form Hnombre',
            'form_hdescripcion' => 'Form Hdescripcion',
            'form_horden' => 'Form Horden',
            'form_hestado' => 'Form Hestado',
        ];
    }

    /**
     * Gets query for [[FormDatosCitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormDatosCitas()
    {
        return $this->hasMany(FormDatosCitas::class, ['form_hid' => 'form_hid']);
    }
}
