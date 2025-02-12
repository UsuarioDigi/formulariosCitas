<?php

namespace app\controllers;

use app\models\FormDatosVisitante;
use app\models\FormDatosVisitanteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormDatosVisitanteController implements the CRUD actions for FormDatosVisitante model.
 */
class FormDatosVisitanteController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all FormDatosVisitante models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FormDatosVisitanteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormDatosVisitante model.
     * @param string $form_dvid Form Dvid
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($form_dvid)
    {
        return $this->render('view', [
            'model' => $this->findModel($form_dvid),
        ]);
    }

    /**
     * Creates a new FormDatosVisitante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new FormDatosVisitante();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'form_dvid' => $model->form_dvid]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FormDatosVisitante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $form_dvid Form Dvid
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($form_dvid)
    {
        $model = $this->findModel($form_dvid);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'form_dvid' => $model->form_dvid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FormDatosVisitante model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $form_dvid Form Dvid
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($form_dvid)
    {
        $this->findModel($form_dvid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FormDatosVisitante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $form_dvid Form Dvid
     * @return FormDatosVisitante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($form_dvid)
    {
        if (($model = FormDatosVisitante::findOne(['form_dvid' => $form_dvid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
