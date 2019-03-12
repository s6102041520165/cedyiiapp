<?php

namespace app\controllers;

use Yii;
use app\models\Diet;
use app\models\DietSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DietController implements the CRUD actions for Diet model.
 */
class DietController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Diet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DietSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Diet model.
     * @param string $dietRow
     * @param integer $dietCol
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($dietRow, $dietCol)
    {
        return $this->render('view', [
            'model' => $this->findModel($dietRow, $dietCol),
        ]);
    }

    /**
     * Creates a new Diet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Diet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'dietRow' => $model->dietRow, 'dietCol' => $model->dietCol]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Diet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $dietRow
     * @param integer $dietCol
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($dietRow, $dietCol)
    {
        $model = $this->findModel($dietRow, $dietCol);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'dietRow' => $model->dietRow, 'dietCol' => $model->dietCol]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Diet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $dietRow
     * @param integer $dietCol
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($dietRow, $dietCol)
    {
        $this->findModel($dietRow, $dietCol)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Diet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $dietRow
     * @param integer $dietCol
     * @return Diet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($dietRow, $dietCol)
    {
        if (($model = Diet::findOne(['dietRow' => $dietRow, 'dietCol' => $dietCol])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
