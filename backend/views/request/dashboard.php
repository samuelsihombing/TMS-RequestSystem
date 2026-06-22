<?php
use yii\helpers\Html;
$this->title = 'Request Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-dashboard">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-card card-pending">
                <div class="card-number"><?= $totalPending ?></div>
                <div class="card-label">Pending</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card card-approved">
                <div class="card-number"><?= $totalApproved ?></div>
                <div class="card-label">Approved</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card" style="border-left-color:#3498db;">
                <div class="card-number"><?= $totalCompleted ?></div>
                <div class="card-label">Completed</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card" style="border-left-color:#e74c3c;">
                <div class="card-number"><?= $totalHighPriority ?></div>
                <div class="card-label">High Priority (Pending)</div>
            </div>
        </div>
    </div>
    <p style="margin-top:1.5rem;">
        <?= Html::a('View All Requests', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Create New Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>