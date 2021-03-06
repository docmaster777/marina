<?php

use app\widgets\MenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-group field-product-category_id has-success">
        <label class="control-label" for="product-category_id">Родительская категория</label>
        <select id="product-category_id" class="form-control" name="Product[category_id]">
            <?= MenuWidget::widget(['tpl' => 'select_product', 'model' => $model])?>
        </select>
    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),
    ]); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'hit')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'new')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'sale')->checkbox(['0', '1']) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <div class="view__product">

        <?  if($model->getImages()):?>
            <?php $images = $model->getImages();
            foreach ($images as $image):
                echo Html::img('/web/upload/store/' . $image->filePath, ['width' => '150', 'class' => 'postImg'.$image->id]); ?>
                <?php if($image->id){
                    echo Html::a("<span title ='удалить' class='glyphicon glyphicon-remove $image->id'></span>", ['product/deleteimage', 'idimg' => $image->id, 'id' => $model->id], [
                        'onclick'=>
                            "$.ajax({
                                type:'POST',
                                cache: false,
                                url: '".Url::to(['product/deleteimage', 'idimg' => $image->id, 'id' => $model->id])."',
                                success  : function(response) {
                                    $('.link-del$image->id').html(response);
                                    $('.postImg$image->id').hide(300);
                                    $('.$image->id').hide(300);
                                    setTimeout(function() { $('.alert__text$image->id').hide('slow'); }, 1500);
                                }
                            });
                            return false;",
                    ]);
                }?>
            <?php endforeach; ?>
        <?php endif; ?>


    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           