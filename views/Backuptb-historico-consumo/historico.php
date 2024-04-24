<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\grid\EditableColumn;
use yii\bootstrap\Collapse;
use yii\data\ActiveDataProvider;
//use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use kartik\editable\Editable;
use yii\widgets\DatePicker;
use app\models\TbCliente;
use app\models\TbProduto;
use app\models\TbEstoque;
use kartik\select2\Select2;

use yii\helpers\ArrayHelper;
use app\models\TbProdutoSearch;
use yii\widgets\MaskedInput;
use yii\bootstrap4\Modal;

$clienteModel = new TbCliente();
$produtoModel = new TbProduto();
$estoqueModel = new TbEstoque();


/** @var yii\web\View $this */
/** @var app\models\TbHistoricoConsumo $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="content">
    <div class="tb-historico-consumo-form">

        <?php $form = ActiveForm::begin(); ?>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                    <h4>&nbsp1 - Produto:</h4>
                                    </h3>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-6">
                                    <div class="container-fluid w-auto row">
                                        <?php
                                            $id = Yii::$app->request->get('id_estoque');
                                            if($id !== null) {
                                                //Apenas Update(Atualização)
                                                $produtoModel->num_produto = $xb->num_produto;
                                                $produtoModel->nome_produto = $xb->nome_produto;
                                                $produtoModel->estado_produto = $xb->estado_produto;
                                                $produtoModel->preco_produto = $xb->preco_produto;
                                                //var_dump($xb->num_produto)
                                                ?>
                                                <div class="col-lg-2 col-sm-12 col-xs-12 col-md-6">
                                                    <?= $form->field($produtoModel, 'num_produto')->textInput(['readonly'=> true, 'maxlength' => true])->label('Código Produto') ?>
                                                    <?php //echo $numProduto;
                                                    //var_dump(TbProduto::getProdutos()); die; ?>
                                                </div>
                                                <div class="col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                    <?= $form->field($produtoModel, 'nome_produto')->textInput(['readonly'=> true, 'maxlength' => true, 'id' => 'nome_produto', ])->label('Nome Produto') ?>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 col-xs-12 col-md-6">
                                                    <?= $form->field($produtoModel, 'estado_produto')->textInput(['readonly'=> true, 'maxlength' => true, 'id' => 'estado_produto'])->label('Estado Produto') ?>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 col-xs-12 col-md-6">
                                                    <?php //$form->field($produtoModel, 'preco_produto')->textInput(['readonly'=> true, 'id' => 'preco_produto'])->label('Preço Produto') ?>

                                                    <?= $form->field($produtoModel, 'preco_produto')->widget(MaskedInput::className(), [
                                                        'clientOptions' => [
                                                            'alias' => 'currency',
                                                            'prefix' => 'R$ ',
                                                            'digits' => 2,
                                                            'digitsOptional' => false,
                                                            'radixPoint' => ',',
                                                            'groupSeparator' => '.',
                                                            'autoGroup' => true,
                                                            'removeMaskOnSubmit' => true,
                                                        ],
                                                        'options' => ['style'=> ' ', 'class'=> 'input form-control ','readonly' => true, // Adiciona a opção para deixar somente leitura
                                                        ]
                                                    ])->label('Preço Produto') ?>
                                                    <style>
                                                        input[name="TbProduto[preco_produto]"].form-control {
                                                            text-align: left;
                                                        }
                                                    </style>
                                                <?php



                                            } else {
                                                //Apenas Create(Novo item)
                                                ?>
                                                <div class="col-lg-2 col-sm-12 col-xs-12 col-md-6">
                                                    <?= $form->field($produtoModel, 'num_produto')->widget(Select2::classname(), [
                                                        'data' => TbProduto::getProdutos(),
                                                        'options' => ['placeholder' => 'Selecione um produto', 'id' => 'num_produto_select2'],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                        ],
                                                        'pluginEvents' => [
                                                            "change" => "function() {
                                                                if ($(this).val().length > 3) {
                                                                    $.post('/tb-estoque/obter-dados-saldo-estoque?num_produto=' + $(this).val(), function(data) {
                                                                        var vl = JSON.parse(data);
                                                                        $('input#nome_produto').val(vl[1]);
                                                                        $('input#estado_produto').val(vl[2]);

                                                                        $('input#preco_produto').val('R$ ' + Number(vl[3]).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                                                        $('input#num_produto_estoque').val(vl[0]);
                                                                        $('input#tbestoque-qtd_itens').val(vl[4]);
                                                                        $('input#tbestoque-endereco_item').val(vl[5]);
                                                                        $('input#tbestoque-id_estoque').val(vl[6]);

                                                                        $('input#tbhistoricoconsumo-id_num_produto').val(vl[0]);
                                                                        $('input#tbhistoricoconsumo-id_estoque').val(vl[6]);








                                                                        //Para vincular o código do produto à ID Estoque
                                                                        var num_produto_estoque = $('#num_produto_estoque').val();
                                                                        var id_estoque = $('#id_estoque');

                                                                        id_estoque.val(num_produto_estoque);

                                                                    });
                                                                } else {
                                                                    alert('Erro');
                                                                }
                                                            }",
                                                        ],
                                                    ]);



                                                    ?>
                                                    <?php //echo $numProduto;
                                                    //var_dump(TbProduto::getProdutos()); die; ?>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                                                    <?= $form->field($produtoModel, 'nome_produto')->textInput(['readonly'=> true, 'maxlength' => true, 'id' => 'nome_produto', ])->label('Nome Produto') ?>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 col-xs-12 col-md-6">
                                                    <?= $form->field($produtoModel, 'estado_produto')->textInput(['readonly'=> true, 'maxlength' => true, 'id' => 'estado_produto'])->label('Estado Produto') ?>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 col-xs-12 col-md-6">
                                                    <?= $form->field($produtoModel, 'preco_produto')->textInput(['readonly'=> true, 'id' => 'preco_produto'])->label('Preço Produto') ?>
                                                    <?php /*$form->field($model, 'preco_produto')->widget(MaskedInput::className(), [
                                                        'clientOptions' => [
                                                            'alias' => 'currency',
                                                            'prefix' => 'R$ ',
                                                            'digits' => 2,
                                                            'digitsOptional' => false,
                                                            'radixPoint' => ',',
                                                            'groupSeparator' => '.',
                                                            'autoGroup' => true,
                                                            'removeMaskOnSubmit' => true,
                                                        ],
                                                        'options' => ['style'=> ' ', 'class'=> 'input form-control ','readonly' => true, ]
                                                    ])->label('Preço Produto') */ ?>
                                                    <!--style>
                                                        input[name="TbProduto[preco_produto]"].form-control {
                                                            text-align: left;
                                                        }
                                                    </style-->
                                                </div>
                                            <?php

                                            }
                                        ?>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                    <h4>&nbsp2 - Saldo Estoque:  </h4>
                                    </h3>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-6">
                                    <div class="container-fluid w-auto row">
                                        <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                                        <?= $form->field($estoqueModel, 'id_estoque')->textInput(['readonly'=> true])->label('Id Estoque') ?>
                                            <?= $form->field($estoqueModel, 'qtd_itens')->textInput(['readonly'=> true])->label('Qtd Itens') ?>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                                            <?= $form->field($estoqueModel, 'endereco_item')->textInput(['readonly'=> true, 'maxlength' => true])->label('Endereço Item') ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                    <i class="fas fa-edit"></i>
                                    <h4>&nbsp3 - Inserir consumo:  </h4>
                                    </h3>
                                </div>
                                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-6">
                                    <div class="container-fluid w-auto row">
                                            <?= $form->field($model, 'id_estoque')->textInput(['readonly'=> true]) ?>
                                            <?= $form->field($model, 'id_num_produto')->textInput(['readonly'=> true]) ?>
                                            <?= $form->field($model, 'id_cliente_cpf_cnpj')->widget(MaskedInput::class, [
                                                'mask' => ['999.999.999-99', '99.999.999/9999-99'], // Define as máscaras para CPF e CNPJ
                                                'options' => ['maxlength' => true],
                                                'clientOptions' => [
                                                    'removeMaskOnSubmit' => true, // Remove a máscara antes de enviar o formulário
                                                ],
                                            ])->textInput(['maxlength' => true, 'readonly' => true]) ?>
                                        <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                                            <?= $form->field($model, 'qtd_consumida')->textInput() ?>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                                            <?= $form->field($model, 'data_consumo')->textInput(['type' => 'date']) ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



        <?php //$form->field($model, 'id_cliente_cpf_cnpj')->textInput() ?>



        <?php  //$form->field($model, 'id_consumo')->textInput() ?>

        <?php //$form->field($model, 'id_estoque')->textInput() ?>

        <?php //$form->field($model, 'id_num_produto')->textInput() ?>




        <div class="modal-footer justify-content-between">
            <div class="col-lg-2 ">
            </div>
            <div class="col-lg-4 ">
                <?= Html::submitButton(Yii::t('app', 'Adicionar Consumo'), ['class' => 'btn btn-success btn-sm']) ?>
            </div>
            <div class="col-lg-2 ">
                <button type="button" class="btn btn-danger btn-block btn-sm" data-dismiss="modal"> Sair</button>
            </div>
            <div class="col-lg-2 ">
            </div>

            </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>