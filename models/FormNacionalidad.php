<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "form_nacionalidad".
 *
 * @property float $form_nid
 * @property string $form_nnombre
 * @property string $form_ndescripcion
 * @property int|null $form_norden
 * @property int|null $form_nestado
 */
class FormNacionalidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_nacionalidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_nid', 'form_nnombre', 'form_ndescripcion'], 'required'],
            [['form_nid'], 'number'],
            [['form_norden', 'form_nestado'], 'default', 'value' => null],
            [['form_norden', 'form_nestado'], 'integer'],
            [['form_nnombre'], 'string', 'max' => 100],
            [['form_ndescripcion'], 'string', 'max' => 200],
            [['form_nid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'form_nid' => 'Form Nid',
            'form_nnombre' => 'Form Nnombre',
            'form_ndescripcion' => 'Form Ndescripcion',
            'form_norden' => 'Form Norden',
            'form_nestado' => 'Form Nestado',
        ];
    }
}
