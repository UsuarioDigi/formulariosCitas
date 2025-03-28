<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "form_datos_facturacion".
 *
 * @property float $form_did
 * @property string $form_dnombres_completos
 * @property string $form_ddireccion
 * @property string $form_dfecha
 * @property string|null $form_dcedula
 * @property string|null $form_dtelefono
 * @property string|null $form_dcorreo
 * @property string $form_dfecha_visita
 * @property int $form_dhora_visita
 * @property string $form_adjunto
 * @property int $form_esoperadora
 * @property int $form_dtcantidad
 * @property int $form_estado_factura
 * @property string $form_ip
 * @property string $form_fecha_registro
 * @property string $form_usuario
 * @property string $form_fecha_actualiza
 * @property int $complejo_id
 */
class FormDatosFacturacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form_datos_facturacion';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_dnombres_completos', 'form_ddireccion', 'form_dfecha', 'form_dfecha_visita', 'form_dhora_visita','form_adjunto','form_dtotal'], 'required', 'message' => 'Este campo no puede estar vacío.'],            
            [['form_dfecha', 'form_dfecha_visita'], 'safe'],
            [['form_dhora_visita'], 'default', 'value' => null],
            [['form_dhora_visita','form_esoperadora','form_dtcantidad','form_estado_factura','complejo_id'], 'integer'],
            [['form_dnombres_completos', 'form_ddireccion'], 'string', 'max' => 200],
            [['form_registro_operadora'], 'string', 'max' => 100],            
            [['form_dcedula'], 'string', 'max' => 150],
            [['form_dcorreo'], 'string', 'max' => 100],               
            [['form_dtelefono'], 'match', 'pattern' => '/^\d{10}$/', 'message' => 'El campo debe contener exactamente 10 dígitos numéricos.'],
            [['form_dcorreo'], 'email','message' => 'La dirección de correo no es válida.'],
            [['form_adjunto'], 'file', 'skipOnEmpty' => true],
            [['form_dtotal'], 'number'],
            [['form_dcedula'], 'required', 'message' => 'Este campo no puede estar vacío.','when' => function($model) {
                return $model->form_esoperadora == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#formdatosfacturacion-form_esoperadora').val() == '1';
            }"],
            [['form_dcedula'], 'match', 'pattern' => '/^\d{13}$/', 'message' => 'El número de RUC debe contener exactamente 13 dígitos numéricos.', 'when' => function($model) {
                return $model->form_esoperadora == 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#formdatosfacturacion-form_esoperadora').val() == '1';
            }"],
            [['form_dcedula'], 'string', 'max' => 255, 'when' => function($model) {
                return $model->form_esoperadora != 1;
            }, 'whenClient' => "function (attribute, value) {
                return $('#formdatosfacturacion-form_esoperadora').val() != '1';
            }"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'form_did' => 'Form Did',
            'form_dnombres_completos' => 'NOMBRES COMPLETOS O RAZÓN SOCIAL',
            'form_ddireccion' => 'DIRECCIÓN',
            'form_dfecha' => 'FECHA',
            'form_dcedula' => 'No. CÉDULA / RUC:',
            'form_dtelefono' => 'TELÉFONO:',
            'form_dcorreo' => 'CORREO: ',
            'form_dfecha_visita' => 'FECHA VISITA',
            'form_dhora_visita' => 'HORA VISITA',
            'form_dtotal' =>'VALOR TOTAL',
            'form_dtcantidad'=>'TOTAL BOLETOS',
            'form_estado_factura' =>'ESTADO'
        ];
    }
    public function getFormDatosVisitantes() 
    { 
        return $this->hasMany(FormDatosVisitante::class, ['form_did' => 'form_did']);         
    }
    public function getHorario()
    {
        return $this->hasOne(FormHorarios::class, ['form_hid' => 'form_dhora_visita']);
    }
  
}