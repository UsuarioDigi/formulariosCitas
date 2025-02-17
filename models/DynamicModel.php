<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;

class DynamicModel extends Model
{
    /**
     * Crea múltiples instancias de un modelo.
     * @param string $modelClass La clase del modelo.
     * @param array $multipleModels Arreglo de modelos existentes.
     * @return array Nuevas instancias del modelo.
     */
    public static function createMultiple($modelClass, $multipleModels = [])
    {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = \Yii::$app->request->post($formName);
        $models = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

    /**
     * Carga múltiples instancias de un modelo.
     * @param array $models Arreglo de modelos.
     * @param array $data Datos para cargar en los modelos.
     * @param string|null $formName Nombre del formulario.
     * @return boolean Si la carga de datos fue exitosa.
     */
    public static function loadMultiple($models, $data, $formName = null)
    {
        return Model::loadMultiple($models, $data, $formName);
    }

    /**
     * Valida múltiples instancias de un modelo.
     * @param array $models Arreglo de modelos.
     * @param array $attributeNames Nombres de atributos a validar.
     * @return boolean Si la validación fue exitosa.
     */
    public static function validateMultiple($models, $attributeNames = null)
    {
        $valid = true;
        foreach ($models as $model) {
            $valid = $model->validate($attributeNames) && $valid;
        }

        return $valid;
    }
}