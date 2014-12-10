<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model linchpinstudios\seo\models\SeoPages */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Seo Pages',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
