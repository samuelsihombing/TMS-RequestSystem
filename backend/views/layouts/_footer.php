<?php

declare(strict_types=1);

/** @var yii\web\View $this */

use yii\helpers\Html;

?>
<footer id="footer" class="mt-auto py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <span class="footer-brand">
                    <i class="fa-solid fa-gears"></i> <?= Html::encode(Yii::$app->name) ?>
                </span>
                <span class="footer-copyright">&copy; <?= date('Y') ?> All rights reserved.</span>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <span class="footer-tagline">Business Unit Request Management System</span>
            </div>
        </div>
    </div>
</footer>