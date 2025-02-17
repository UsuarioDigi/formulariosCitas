<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "form_datos_visitante".
 *
 * @property int $form_dvid
 * @property int|null $form_did
 * @property string $form_dvnombres
 * @property string $form_dvapellidos
 * @property string|null $form_dvcedula
 * @property int $form_dvtipo_visitante
 * @property int $form_dvnacionalidad
 * @property int $form_dvgenero
 * @property string $form_dvfecha_nacimiento
 * @property int $form_dvcantidad
 * @property float|null $form_dvprecio
 * @property float|null $form_dvprecio_total
 *
 * @property FormDatosFacturacion $formD
 */
class FormDatosVisitante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_datos_visitante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_did', 'form_dvtipo_visitante', 'form_dvnacionalidad', 'form_dvgenero', 'form_dvcantidad'], 'default', 'value' => null],
            [['form_did', 'form_dvtipo_visitante', 'form_dvnacionalidad', 'form_dvgenero', 'form_dvcantidad','form_dvoriginario'], 'integer'],
            [['form_dvtipo_visitante', 'form_dvnacionalidad', 'form_dvgenero', 'form_dvcantidad','form_dvoriginario','form_dvprecio', 'form_dvprecio_total'], 'required','message' => 'El campo no debe ser vacío.'],
            [['form_dvfecha_nacimiento'], 'safe'],
            [['form_dvprecio', 'form_dvprecio_total'], 'number'],
            [['form_dvnombres', 'form_dvapellidos'], 'string', 'max' => 200],
            [['form_dvcedula'], 'string', 'max' => 150],
            [['form_did'], 'exist', 'skipOnError' => true, 'targetClass' => FormDatosFacturacion::class, 'targetAttribute' => ['form_did' => 'form_did']],            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'form_dvid' => 'Form Dvid',
            'form_did' => 'Form Did',
            'form_dvnombres' => 'Nombres',
            'form_dvapellidos' => 'Apellidos',
            'form_dvcedula' => 'Cédula',
            'form_dvoriginario'=>'Origen visita',
            'form_dvtipo_visitante' => 'Tipo visitante',
            'form_dvnacionalidad' => 'Nacionalidad',
            'form_dvgenero' => 'Form Dvgenero',
            'form_dvfecha_nacimiento' => 'Form Dvfecha Nacimiento',
            'form_dvcantidad' => 'Cantidad',
            'form_dvprecio' => 'Precio',
            'form_dvprecio_total' => 'Precio Total',
        ];
    }

    /**
     * Gets query for [[FormD]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFormD()
    {
        return $this->hasOne(FormDatosFacturacion::class, ['form_did' => 'form_did']);
    }
    public function getTipovisitante()
    {
        return $this->hasOne(FormTipoVisitante::class, ['form_tvid' => 'form_dvtipo_visitante']);
    }
    public function getNacionalidad()
    {
        return $this->hasOne(FormNacionalidad::class, ['form_nid' => 'form_dvnacionalidad']);
    }
}
