<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TbCliente $model */

$this->title = Yii::t('app', 'Cadastrar Cliente');
$this->params['breadcrumbs'][] = ['label' => 'Voltar', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tb Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-cliente-create">

    <!--h1>< ?= Html::encode($this->title) ?></h1-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
