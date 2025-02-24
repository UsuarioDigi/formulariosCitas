<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

use yii\web\JqueryAsset;
use wbraganca\dynamicform\DynamicFormAsset;

JqueryAsset::register($this);
DynamicFormAsset::register($this);
AppAsset::register($this);

$this->registerJsFile('@web/js/funciones_generales.js', ['depends' => [JqueryAsset::class]]); 
?>

<!-- Incluir CSS de Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">

<!-- Incluir JavaScript de Flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/es.js"></script>


<?php
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    // Verifica la ruta actual
$currentRoute = Yii::$app->controller->getRoute();
$showNavItems = $currentRoute === 'form-datos-facturacion/index';
echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $showNavItems ? [
        Yii::$app->user->isGuest
            ? ['label' => 'Login', 'url' => ['/site/login']]
            : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
    ] : [],
]);
    NavBar::end();
    ?>
</header>
<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
    <?php if (!(Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'login')): ?>
        <div class="banner">
            <img src="<?= Url::to('@web/images/banner.jpg') ?>" alt="Banner" class="img-responsive">
        </div>
    <?php endif; ?>
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; Instituto Nacional de Patrimonio Cultural <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"></div>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>