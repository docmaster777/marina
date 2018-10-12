<?php
/**
 * Created by PhpStorm.
 * User: 555
 * Date: 11.10.2018
 * Time: 23:19
 */

namespace app\controllers;


use app\models\Product;

class CategoryController extends AppController
{

    public function actionView()
    {
        $category_id = 1;
        $products = Product::find()->where(['category_id' => $category_id])->all();
        return $this->render('view', ['products' => $products]);
    }
}