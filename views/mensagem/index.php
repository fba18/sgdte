<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
use app\models\Mensagem;
use yii\bootstrap\Carousel;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchMensagem */
/* @var $dataProvider yii\data\ActiveDataProvider */


// Breadcrumbs Texto após o "/" Separador
$this->title = 'Mensagem';
//Exibe barra do Breadcrumbs
$this->params['breadcrumbs'][] = $this->title;
//Título:
$this->title = Yii::t('app', 'SGDTE - Início');


//echo phpinfo();

?>

<?php
//Atualizar a página inicial automaticamente
echo "<meta HTTP-EQUIV='refresh' CONTENT='300'>";
?>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Mensagens</h3>
          </div>
          <div class="col-lg-12 col-sm-12 col-xs-12 col-md-6">
            <div class="container-fluid w-auto row">
              <div class="col-lg-3 col-sm-12 col-xs-12 col-md-6">
              </div>
              <div class="col-lg-6 col-sm-12 col-xs-12 col-md-6">
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style= '/* Centralizar na horizontal*/ '>
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="/uploads/imagens/eig-inicial.jfif" style="min-width:100%;max-width:90%;min-height:400px; max-height:500px; text-align:center; " alt="Estou em views/mensagem/index.php">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="/uploads/imagens/eig-dados-contato.png" style="min-width:100%;max-width:90%;min-height:400px; max-height:500px; text-align:center; " alt="Estou em views/mensagem/index.php">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i>
                      </span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-custom-icon" aria-hidden="true">
                        <i class="fas fa-chevron-right"></i>
                      </span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-12 col-xs-12 col-md-6">
              </div>
            </div>
          </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.col -->
  </div>
</section>