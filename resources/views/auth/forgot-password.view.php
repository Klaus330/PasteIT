<?php
/**
* @var $model \app\models\Model
*/
?>
<div class="row">
    <div class="row mt-5">
        <?php $form = \app\forms\Form::begin('/forgot-password', "POST", "login-form simple-form") ?>
            <?= $form->inputField($model, "email")->emailField() ?>
            <?= $form->submitButton('Send Email', 'form-group login-buttons', 'btn btn-primary') ?>
        <?php \app\forms\Form::end() ?>
    </div>
</div>
