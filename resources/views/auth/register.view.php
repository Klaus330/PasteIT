<?php
/** @var $model \app\models\Model*/
$this->setTitle("Reigister")
?>
<div class="row">
    <div class="row mt-3">
        <?php $form = \app\forms\Form::begin('/register', "POST", "register-form simple-form") ?>
            <?= $form->inputField($model, 'username') ?>
            <?= $form->inputField($model, "email")->emailField() ?>
            <?= $form->inputField($model,"password")->passwordField() ?>
            <?= $form->inputField($model, 'confirm_password')->passwordField() ?>
            <?= $form->submitButton('Register', 'form-group login-buttons', 'btn btn-primary') ?>

        <?php \app\forms\Form::end() ?>
    </div>
</div>