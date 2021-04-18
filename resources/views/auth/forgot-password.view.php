<?php
/**
* @var $model \app\models\Model
*/
?>
<div class="row">
    <div class="row mt-5">
        <?php $form = \app\forms\Form::begin('/forgot-password', "POST", "login-form simple-form") ?>
            <div class="grid">
                <div class="col-md-3 col-3">
                    <label for="email" class="form-label">
                        Email:
                    </label>
                </div>
                <div class="col-md-9 col-12">
                    <div class="col-md-9 col-12 flex align-center">
                        <input type="text" name="email" placeholder="Email" value="" class="form-control " id="email">
                    </div>
                </div>
            </div>
            <?= $form->submitButton('Send Email', 'form-group login-buttons', 'btn btn-primary') ?>
        <?php \app\forms\Form::end() ?>
    </div>
</div>
