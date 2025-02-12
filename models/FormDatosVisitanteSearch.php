<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FormDatosVisitante;

/**
 * FormDatosVisitanteSearch represents the model behind the search form of `app\models\FormDatosVisitante`.
 */
class FormDatosVisitanteSearch extends FormDatosVisitante
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_did', 'form_dvid', 'form_dvprecio', 'form_dvprecio_total'], 'number'],
            [['form_dvnombres', 'form_dvapellidos', 'form_dvcedula', 'form_dvfecha_nacimiento'], 'safe'],
            [['form_dvtipo_visitante', 'form_dvnacionalidad', 'form_dvgenero', 'form_dvcantidad'], 'integer'],
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
        $query = FormDatosVisitante::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'form_did' => $this->form_did,
            'form_dvid' => $this->form_dvid,
            'form_dvtipo_visitante' => $this->form_dvtipo_visitante,
            'form_dvnacionalidad' => $this->form_dvnacionalidad,
            'form_dvgenero' => $this->form_dvgenero,
            'form_dvfecha_nacimiento' => $this->form_dvfecha_nacimiento,
            'form_dvcantidad' => $this->form_dvcantidad,
            'form_dvprecio' => $this->form_dvprecio,
            'form_dvprecio_total' => $this->form_dvprecio_total,
        ]);

        $query->andFilterWhere(['ilike', 'form_dvnombres', $this->form_dvnombres])
            ->andFilterWhere(['ilike', 'form_dvapellidos', $this->form_dvapellidos])
            ->andFilterWhere(['ilike', 'form_dvcedula', $this->form_dvcedula]);

        return $dataProvider;
    }
}
