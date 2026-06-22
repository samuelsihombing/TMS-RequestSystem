<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;

$username = Yii::$app->user->identity?->username;
$avatarLetter = $username ? mb_strtoupper(mb_substr($username, 0, 1)) : '?';
$isGuest = Yii::$app->user->isGuest;

$items = [
    [
        'label' => '<i class="fa-solid fa-house"></i> Home',
        'url' => ['/site/index'],
    ],
    [
        'label' => '<i class="fa-solid fa-list-check"></i> Requests',
        'url' => ['/request/dashboard'],
        'visible' => !$isGuest && Yii::$app->user->can('createRequest'),
    ],
    [
        'label' => '<i class="fa-solid fa-building"></i> Business Units',
        'url' => ['/business-unit/index'],
        'visible' => !$isGuest && Yii::$app->user->can('manageMasterData'),
    ],
    [
        'label' => '<i class="fa-solid fa-tags"></i> Request Types',
        'url' => ['/request-type/index'],
        'visible' => !$isGuest && Yii::$app->user->can('manageMasterData'),
    ],
    [
        'label' => '<i class="fa-solid fa-right-to-bracket"></i> Login',
        'url' => ['/site/login'],
        'visible' => $isGuest,
    ],
];
?>
<header id="header">
    <?php NavBar::begin(
        [
            'brandLabel' => '<i class="fa-solid fa-gears"></i> ' . Html::encode(Yii::$app->name),
            'brandOptions' => ['encode' => false],
            'brandUrl' => Yii::$app->homeUrl,
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
        ],
    ) ?>
    <?= Nav::widget(
        [
            'options' => ['class' => 'navbar-nav me-auto'],
            'encodeLabels' => false,
            'items' => $items,
        ],
    ) ?>

   <div class="navbar-right-section">
    <?php if (!$isGuest): ?>
        <span class="user-avatar"><?= Html::encode($avatarLetter) ?></span>
        <span class="user-name"><?= Html::encode($username) ?></span>
        <?= Html::a(
            '<i class="fa-solid fa-right-from-bracket"></i>',
            ['/site/logout'],
            [
                'class' => 'btn btn-link nav-link logout-btn',
                'data-method' => 'post',
                'title' => 'Logout',
            ]
        ) ?>
        <?= Html::button(
    '&#127769;',
    [
        'id' => 'theme-toggle',
        'class' => 'btn btn-link nav-link fs-5',
        'aria-label' => 'Switch to dark mode',
    ],
) ?>
    <?php endif; ?>


    <?php NavBar::end() ?> -->
</header>