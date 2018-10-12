<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Image;
use Yii;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())){
                $model->save();

//            --загрузка одной картинки--
                $model->image = UploadedFile::getInstance($model, 'image');
            if( $model->image ){
                $model->uploadCreate();
            }
            unset($model->image);
//            --загрузка нескольких картинок--
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            $model->uploadsCreate();

            Yii::$app->session->setFlash('success', "Товар {$model->name} добавлен");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        $image = Image::find()->andWhere(['itemId' => 15])->andWhere(['id' => 118])->one();
//        debug(stristr($image->filePath, '/', true));

        $model = $this->findModel($id);

        $current_image = Image::find()->andWhere(['itemId' => $id])->andWhere(['isMain' => 1]) ->one();

        if ($model->load(Yii::$app->request->post())){
            $model->save();
//            загрузка одной картинки
            $image = $model->image = UploadedFile::getInstance($model, 'image');
            if($current_image & $image ==!null){
                $model->updateImage($image, $current_image);
                $current_image->delete();
            }elseif($image){
                $model->uploadCreate();
            }

//              загрузка нескольких картинок
            $images = $model->gallery = UploadedFile::getInstances($model, 'gallery');
            if($images == !null){
                $model->updateImages();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeleteimage($idimg, $id)
    {
        $image = Image::find()->andWhere(['itemId' => $id])->andWhere(['id' => $idimg])->one();
        unlink('upload/store/' . $image->filePath);
        $image->delete();
        $name_madel = stristr($image->filePath, '/', true);
        $directory = array_splice(scandir('upload/store/' .$name_madel . '/' . $image->modelName . $id),2);
        if(!$directory[0]){
            rmdir('upload/store/' .$name_madel .'/' .$image->modelName .$image->itemId);
        }
    }
}
