<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model linchpinstudios\seo\models\SeoMeta */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Seo Meta',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo Metas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-meta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pages' => $pages,
    ]) ?>

</div>
