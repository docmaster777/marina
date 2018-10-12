<?php
/**
 * Created by PhpStorm.
 * User: 555
 * Date: 11.10.2018
 * Time: 23:19
 */

namespace app\controllers;
use yii\web\Controller;

class AppController extends Controller
{
    public $layout = 'main';

    protected function setMeta($title = null, $description = null, $keywords = null){
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
    }
}