<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TbEstoque $model */

$this->title = 'Atualizar Saldo Estoque: ';
$this->params['breadcrumbs'][] = ['label' => 'Voltar', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id_estoque, 'url' => ['view', 'id_estoque' => $model->id_estoque]];
$this->params['breadcrumbs'][] = 'Atualizar Saldo Estoque';
?>
<div class="tb-estoque-update">

    <!--h1><?= Html::encode($this->title) ?></h1-->
    <div id="message" class='col-lg-12 alertflipper ' > <?php if (Yii::$app->session->hasFlash('error')): ?>
 		 <div class="alert alert-success alert-dismissable col-lg-4" style="position:absolute;top:180px;left:150px;z-index:1000000;">
  		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  		<h3><i class="icon fa fa-check"></i>Atenção!</h3>
  		<?= Yii::$app->session->getFlash('error') ?>
 		 </div>
	 <?php endif; ?>
    </div>

    <?php $xb = $produtoModel; //var_dump($produtoModel); ?>

    <?= $this->render('_form', [
        'model' => $model,
        'xb' => $xb,
    ]) ?>

</div>
