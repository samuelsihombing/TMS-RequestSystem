<?php

use yii\helpers\Html;
use common\models\Request;

/** @var yii\web\View $this */
/** @var common\models\Request $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$statusClassMap = [
    Request::STATUS_PENDING => 'status-pending',
    Request::STATUS_APPROVED => 'status-approved',
    Request::STATUS_REJECTED => 'status-rejected',
    Request::STATUS_COMPLETED => 'status-completed',
];
$statusClass = $statusClassMap[$model->status] ?? '';

$priorityClass = $model->priority == Request::PRIORITY_HIGH
    ? 'priority-high'
    : ($model->priority == Request::PRIORITY_MEDIUM ? 'priority-medium' : 'priority-low');
?>
<div class="request-view">

    <div class="detail-header-card">
        <div class="detail-header-top">
            <div>
                <span class="detail-badge <?= $statusClass ?>"><?= Request::getStatusLabel($model->status) ?></span>
                <span class="detail-badge <?= $priorityClass ?>"><?= Request::getPriorityLabel($model->priority) ?> Priority</span>
            </div>
            <div class="detail-actions">
                <?php if ($model->status == Request::STATUS_PENDING): ?>
                    <?= Html::a('<i class="fa-solid fa-check"></i> Approve', ['approve', 'id' => $model->id], [
                        'class' => 'btn btn-success',
                        'data' => ['confirm' => 'Yakin approve request ini?', 'method' => 'post'],
                    ]) ?>
                    <?= Html::a('<i class="fa-solid fa-xmark"></i> Reject', ['reject', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => ['confirm' => 'Yakin reject request ini?', 'method' => 'post'],
                    ]) ?>
                <?php elseif ($model->status == Request::STATUS_APPROVED): ?>
                    <?= Html::a('<i class="fa-solid fa-flag-checkered"></i> Mark as Completed', ['complete', 'id' => $model->id], [
                        'class' => 'btn btn-primary',
                        'data' => ['confirm' => 'Tandai request ini selesai?', 'method' => 'post'],
                    ]) ?>
                <?php endif; ?>
                <?= Html::a('<i class="fa-solid fa-pen"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-icon-outline', 'title' => 'Edit']) ?>
                <?= Html::a('<i class="fa-solid fa-trash"></i>', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-icon-outline btn-icon-danger',
                    'title' => 'Delete',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

        <h1><?= Html::encode($model->title) ?></h1>
        <p class="detail-subtitle">
            <i class="fa-solid fa-hashtag"></i> Request #<?= $model->id ?>
            &nbsp;&middot;&nbsp;
            <i class="fa-solid fa-user"></i> <?= Html::encode($model->user->username) ?>
            &nbsp;&middot;&nbsp;
            <i class="fa-solid fa-calendar"></i> <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d M Y, H:i') ?>
        </p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="detail-section-card">
                <h3 class="detail-section-title"><i class="fa-solid fa-align-left"></i> Description</h3>
                <p class="detail-description"><?= nl2br(Html::encode($model->description)) ?: '<span class="text-muted">No description provided.</span>' ?></p>
            </div>

            <div class="detail-section-card">
                <h3 class="detail-section-title"><i class="fa-solid fa-clock-rotate-left"></i> Request History</h3>

                <?php if (empty($model->logs)): ?>
                    <p class="text-muted">No history yet. History will appear once this request is approved, rejected, or completed.</p>
                <?php else: ?>
                    <div class="timeline">
                        <?php foreach ($model->logs as $log): ?>
                            <?php
                            $logClass = $statusClassMap[$log->status] ?? '';
                            $logIcon = match ($log->status) {
                                Request::STATUS_APPROVED => 'fa-check',
                                Request::STATUS_REJECTED => 'fa-xmark',
                                Request::STATUS_COMPLETED => 'fa-flag-checkered',
                                default => 'fa-clock',
                            };
                            ?>
                            <div class="timeline-item">
                                <div class="timeline-icon <?= $logClass ?>"><i class="fa-solid <?= $logIcon ?>"></i></div>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        <?= Request::getStatusLabel($log->status) ?>
                                        <span class="timeline-by">by <?= Html::encode($log->changedBy->username) ?></span>
                                    </div>
                                    <div class="timeline-date"><?= Yii::$app->formatter->asDatetime($log->created_at, 'php:d M Y, H:i') ?></div>
                                    <?php if ($log->note): ?>
                                        <div class="timeline-note"><?= Html::encode($log->note) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="detail-section-card">
                <h3 class="detail-section-title"><i class="fa-solid fa-circle-info"></i> Details</h3>
                <dl class="detail-meta-list">
                    <dt>Business Unit</dt>
                    <dd><i class="fa-solid fa-building"></i> <?= Html::encode($model->businessUnit->name) ?></dd>

                    <dt>Request Type</dt>
                    <dd><i class="fa-solid fa-tag"></i> <?= Html::encode($model->requestType->name) ?></dd>

                    <dt>Requested By</dt>
                    <dd><i class="fa-solid fa-user"></i> <?= Html::encode($model->user->username) ?></dd>

                    <dt>Created</dt>
                    <dd><i class="fa-solid fa-calendar-plus"></i> <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d M Y, H:i') ?></dd>

                    <dt>Last Updated</dt>
                    <dd><i class="fa-solid fa-calendar-check"></i> <?= Yii::$app->formatter->asDatetime($model->updated_at, 'php:d M Y, H:i') ?></dd>
                </dl>
            </div>
        </div>
    </div>

</div>