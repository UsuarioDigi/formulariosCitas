<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FormDatosFacturacion;

/**
 * FormDatosFacturacionSearch represents the model behind the search form of `app\models\FormDatosFacturacion`.
 */
class FormDatosFacturacionSearch extends FormDatosFacturacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_did'], 'number'],
            [['form_dnombres_completos', 'form_ddireccion', 'form_dfecha', 'form_dcedula', 'form_dtelefono', 'form_dcorreo', 'form_dfecha_visita','form_estado_factura'], 'safe'],
            [['form_dhora_visita'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FormDatosFacturacion::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
            'defaultOrder' => [
                'form_dfecha_visita' => SORT_ASC // o SORT_ASC
            ]
        ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // Ajusta la búsqueda para convertir valores legibles a numéricos
        if ($this->form_estado_factura == 'PENDIENTE') {
            $this->form_estado_factura = 1;
        } elseif ($this->form_estado_factura == 'REVISADO') {
            $this->form_estado_factura = 2;
        }
        elseif ($this->form_estado_factura == 'RECHAZADO') {
            $this->form_estado_factura = 2;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'form_did' => $this->form_did,
            'form_dfecha' => $this->form_dfecha,
            'form_dfecha_visita' => $this->form_dfecha_visita,
            'form_dhora_visita' => $this->form_dhora_visita,
            'form_estado_factura' => $this->form_estado_factura,
        ]);

        $query->andFilterWhere(['ilike', 'form_dnombres_completos', $this->form_dnombres_completos])
            ->andFilterWhere(['ilike', 'form_ddireccion', $this->form_ddireccion])
            ->andFilterWhere(['ilike', 'form_dcedula', $this->form_dcedula])
            ->andFilterWhere(['ilike', 'form_dtelefono', $this->form_dtelefono])
            ->andFilterWhere(['ilike', 'form_dcorreo', $this->form_dcorreo]);

        return $dataProvider;
    }
}