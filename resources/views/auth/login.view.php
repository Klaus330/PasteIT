<?php
 /** @var $model \app\models\User*/
?>

<div class="row">
    <div class="row mt-3">
        <?php $form = \app\forms\Form::begin('/login', "POST", "register-form simple-form") ?>
            <?php echo $form->inputField($model, 'email') ?>
            <?php echo $form->inputField($model,"password")->passwordField() ?>
            <div class="form-group mt-2 login-buttons">
                <?php echo $form->submitButton('Login', '', 'btn btn-primary') ?>
                <a href="/register" class="btn btn-dark mr-1">
                    Create new account
                </a>
            </div>
            <div class="grid">
                <div class="col-md-8 col-5 ">
                </div>

                <div class="col-md-4 col-7 mt-2">
                    <a href="/forgot-password" class="btn-link">
                        Forgot your password?
                    </a>
                </div>

            </div>

        <?php \app\forms\Form::end() ?>
    </div>
</div>
