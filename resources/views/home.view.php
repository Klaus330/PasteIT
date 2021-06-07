<?php
$this->setTitle("Paste It - Home");
?>

<div class="home-section section">
    <?php $form = \app\forms\Form::begin('/pastes', "POST") ?>
        <div class="row home-first">
            <div class="home-paste">
                <label for="pasteit" class="h4">New Paste</label>
                <textarea name="code" id="pasteit" cols="30" rows="15"></textarea>
                <?php if(array_key_exists('code',$errors)): ?>
                    <span class="text-danger">
                        <?= $errors['code'][0]?>
                    </span>
                <?php endif; ?>
            </div>
            <aside class="home-aside sm-hidden">
                <h4 class="h4">Public Pastes</h4>
                <ul class="list-group">
                    <?php foreach ($latestPastes as $paste): ?>
                        <li class="list-group-item">
                            <a href="/paste/view/<?= $paste->slug ?>"><?= $paste->title ?></a>
                            <span><?= $paste->syntax()->name ?> | <?= $paste->timeSinceCreation() ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
        <div class="row">
            <h4 class="section-title h4">Optional Paste Settings</h4>
            <div class="home-form">

                <div class="grid">
                    <div class="col-7 col-md-3 flex align-start">
                        <label class="form-label" for="syn-highlight">Syntax Highlighting:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="id_syntax" id="syn-highlight" class="form-select">
                            <option value="" disabled>None</option>
                            <?php foreach ($syntaxes as $key => $syntax) : ?>
                                <option value="<?= $syntax->id ?>" <?=  (session()->has('user') && auth()->settings()->id_syntax == $syntax->id) ? 'selected' : '' ?>><?= $syntax->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="grid">
                    <?php if (app()::isGuest()): ?>
                        <input type="hidden" name="exposure" value="">
                    <?php else: ?>
                    <div class="col-5 col-md-3 flex align-start">
                        <label class="form-label" for="exposure">Paste Exposure:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="exposure" id="exposure" class="form-select">
                            <option value="" <?=  (session()->has('user') && auth()->settings()->exposure == 0) ? 'selected' : '' ?>>Public</option>
                            <option value="1" <?=  (session()->has('user') && auth()->settings()->exposure == 1) ? 'selected' : '' ?>>Private</option>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="grid">
                    <?php if (app()::isGuest()): ?>
                        <input type="hidden" name="expiration_date" value="1 month">
                    <?php else: ?>
                    <div class="col-5 col-md-3 flex align-start">
                        <label class="form-label" for="expiration_date">Expiration Date:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="expiration_date" id="expiration_date" class="form-select">
                            <option value="never" <?=  (session()->has('user') && auth()->settings()->expiration == 'never') ? 'selected' : '' ?>>Never</option>
                            <option value="1 min" <?=  (session()->has('user') && auth()->settings()->expiration == '1 min') ? 'selected' : '' ?>>1 Minutes</option>
                            <option value="10 min" <?=  (session()->has('user') && auth()->settings()->expiration == '10 min') ? 'selected' : '' ?>>10 Minutes</option>
                            <option value="1 hour" <?=  (session()->has('user') && auth()->settings()->expiration == '1 hour') ? 'selected' : '' ?>>1 Hour</option>
                            <option value="1 day" <?=  (session()->has('user') && auth()->settings()->expiration == '1 day') ? 'selected' : '' ?>>1 Day</option>
                            <option value="1 week" <?=  (session()->has('user') && auth()->settings()->expiration == '1 week') ? 'selected' : '' ?>>1 Week</option>
                            <option value="1 month" <?=  (session()->has('user') && auth()->settings()->expiration == '1 month') ? 'selected' : '' ?>>1 Month</option>
                            <option value="1 year" <?=  (session()->has('user') && auth()->settings()->expiration == '1 year') ? 'selected' : '' ?>>1 Year</option>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="grid">
                    <div class="col-md-3 flex align-start">
                        <label class="form-label" for="password">Password:</label>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="col-md-9  flex align-center">
                            <input type="checkbox" class="form-check-input" name="password-allow" id="password-allow">
                            <label class="form-label" for="password-allow" id="passworda-allow-label">Disabled</label>
                        </div>
                        <div class="col-md-6 col-12">
                            <input type="text" placeholder="Password" class="form-control" name="password" id="password"
                                   disabled>
                        </div>
                    </div>
                </div>


                <div class="grid">
                    <div class="col-md-offset-3"></div>
                    <div class="form-check col-10 col-md-8 flex align-start">
                        <input type="checkbox" class="form-check-input" name="burn_after_read" id="burn">
                        <label class="form-label" for="burn">Burn after read</label>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-6 col-md-3 flex align-start">
                        <label class="form-label" for="title">Paste Name/Title:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <input type="text" placeholder="Title" class="form-control" name="title" id="title">
                    </div>
                    <div class="col-12 flex align-start">
                    <?php if(array_key_exists('title',$errors)): ?>
                        <span class="text-danger">
                                <?= $errors['title'][0]?>
                        </span>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="grid">
                    <div class="col-12 col-md-6 flex align-center">
                        <?php if (app()::isGuest()): ?>
                            <input type="hidden" name="id_user" id="id_user" value="1">
                        <?php else: ?>
                            <input type="hidden" name="id_user" id="id_user" value="<?= auth()->id ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (app()::isGuest()): ?>
                    <div class="grid">
                        <div class="col-6 col-md-3 flex align-start">
                            <label class="form-label" for="captcha-code">Captcha:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <input type="text" placeholder="Write the code" class="form-control" name="captcha_code"
                                   id="captcha-code">
                        </div>
                        <div class="col-12 col-md-3 flex align-center">
                            <img src="<?= $captchaCode ?>" alt="Captcha code" id="captcha-code-image">
                        </div>
                        <div class="col-12">
                        <?php if(array_key_exists('captcha',$errors)): ?>
                            <span class="text-danger">
                                <?= $errors['captcha']?>
                            </span>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php endif ?>
                <div class="grid">
                    <div class="col-12 col-md-3 mt-5 flex align-start">
                        <button class="btn btn-dark">Create New Paste</button>
                    </div>
                </div>
            </div>
        </div>

    <?php \app\forms\Form::end() ?>
    <?php require_once dirname(__FILE__) . "/partials/alerts/guestalert.view.php" ?>

</div>

<script>
    let passwordAllowCheckbox = document.getElementById('password-allow');

    passwordAllowCheckbox.addEventListener('click', (e) => {
        let passwordInput = document.getElementById('password');
        let label = document.getElementById('passworda-allow-label');
        if (!e.target.checked) {

            passwordInput.setAttribute("disabled", "true");
        } else {

            passwordInput.removeAttribute("disabled");
            passwordInput.focus();
        }
        label.innerText = e.target.checked ? 'Enabled' : 'Disabled';
    });

</script>