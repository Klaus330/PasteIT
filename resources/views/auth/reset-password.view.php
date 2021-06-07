<?php
/** @var $model \app\models\Model*/
$this->setTitle("Reset password")
?>
<div class="row">
    <h1 class="h1">Reset password</h1>
    <div class="row">
        <?php $form = \app\forms\Form::begin('/reset-password', "POST", "login-form simple-form") ?>
            <?= $form->inputField($model, "password")->passwordField() ?>
            <?= $form->inputField($model, "confirm_password")->passwordField() ?>
            <?= $form->submitButton('Reset Password', 'form-group login-buttons', 'btn btn-primary') ?>
        <?php \app\forms\Form::end() ?>
    </div>
</div>
