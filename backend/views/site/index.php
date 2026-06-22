<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Dashboard';
$username = Yii::$app->user->identity?->username;
$canManageMasterData = Yii::$app->user->can('manageMasterData');
$canApprove = Yii::$app->user->can('approveRequest');

$hour = (int) date('G');
$greeting = $hour < 11 ? 'Good morning' : ($hour < 15 ? 'Good afternoon' : ($hour < 19 ? 'Good evening' : 'Good evening'));
?>
<div class="site-index">

    <!-- Welcome banner -->
    <div class="dashboard-banner rounded-4 p-4 p-lg-5 mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <p class="banner-greeting mb-1"><?= $greeting ?></p>
                <h1 class="fw-bold mb-2">Welcome back, <?= Html::encode($username) ?></h1>
                <p class="opacity-90 mb-0">
                    This is your Business Unit Request Management dashboard. Track, submit, and manage requests across all production units.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <i class="fa-solid fa-industry banner-icon"></i>
            </div>
        </div>
    </div>

    <!-- Quick action cards -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <a href="<?= \yii\helpers\Url::to(['/request/dashboard']) ?>" class="quick-action-card">
                <div class="quick-action-icon qa-icon-blue">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div>
                    <div class="quick-action-title">My Requests</div>
                    <div class="quick-action-desc">View dashboard & request list</div>
                </div>
                <i class="fa-solid fa-chevron-right quick-action-arrow"></i>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="<?= \yii\helpers\Url::to(['/request/create']) ?>" class="quick-action-card">
                <div class="quick-action-icon qa-icon-green">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <div class="quick-action-title">New Request</div>
                    <div class="quick-action-desc">Submit a new request</div>
                </div>
                <i class="fa-solid fa-chevron-right quick-action-arrow"></i>
            </a>
        </div>

        <?php if ($canManageMasterData): ?>
            <div class="col-md-4 mb-3">
                <a href="<?= \yii\helpers\Url::to(['/business-unit/index']) ?>" class="quick-action-card">
                    <div class="quick-action-icon qa-icon-amber">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <div>
                        <div class="quick-action-title">Business Units</div>
                        <div class="quick-action-desc">Manage master data</div>
                    </div>
                    <i class="fa-solid fa-chevron-right quick-action-arrow"></i>
                </a>
            </div>
        <?php elseif ($canApprove): ?>
            <div class="col-md-4 mb-3">
                <a href="<?= \yii\helpers\Url::to(['/request/index']) ?>?RequestSearch%5Bstatus%5D=1" class="quick-action-card">
                    <div class="quick-action-icon qa-icon-amber">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <div class="quick-action-title">Pending Approvals</div>
                        <div class="quick-action-desc">Review requests awaiting action</div>
                    </div>
                    <i class="fa-solid fa-chevron-right quick-action-arrow"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>

</div>