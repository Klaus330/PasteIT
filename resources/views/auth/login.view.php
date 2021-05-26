<?php
 /** @var $model \app\models\Model*/
?>

<div class="row">
    <div class="row mt-3">
        <?php $form = \app\forms\Form::begin('/login', "POST", "register-form simple-form") ?>
            <?= $form->inputField($model, 'email') ?>
            <?= $form->inputField($model,"password")->passwordField() ?>
            <div class="form-group mt-2 login-buttons">
                <?= $form->submitButton('Login', '', 'btn btn-primary') ?>
                <a href="/register" class="btn btn-dark mr-1">
                    Create new account
                </a>
            </div>

        <?php \app\forms\Form::end() ?>
    </div>
</div>
