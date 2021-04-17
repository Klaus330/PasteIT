<?php
/** @var $model \app\models\User*/
?>
<div class="row">
    <div class="row mt-3">
        <?php $form = \app\forms\Form::begin('/register', "POST", "register-form simple-form") ?>


            <?php echo $form->inputField($model, 'username') ?>
            <?php echo $form->inputField($model, "email")->emailField() ?>
            <?php echo $form->inputField($model,"password")->passwordField() ?>
            <?php echo $form->inputField($model, 'confirm_password')->passwordField() ?>
            <?php echo $form->submitButton('Register', 'form-group login-buttons', 'btn btn-primary') ?>

        <?php \app\forms\Form::end() ?>
    </div>
</div>