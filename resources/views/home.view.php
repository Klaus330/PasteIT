<?php
$this->setTitle("Paste It - Home")
?>

<section class="home-section section">
    <form action="/pastes" method="POST">
        <div class="row home-first">
            <div class="home-paste">
                <h4 class="h4">New Paste</h4>
                <textarea name="code" id="pasteit" cols="30" rows="15"></textarea>
            </div>
            <aside class="home-aside sm-hidden">
                <h4 class="h4">Public Pastes</h4>
                <ul class="list-group">
                    <?php foreach ($latestPastes as $paste): ?>
                    <li class="list-group-item">
                        <a href="/paste/view/<?= $paste->slug ?>"><?= $paste->title ?></a>
                        <span><?= $paste->syntax()->name ?> | <?= $paste->user()->username ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </aside>
        </div>
        <div class="row">
            <h4 class="section-title h4">Optional Paste Settings</h4>
            <div class="home-form" >

                <div class="grid">
                    <div class="col-7 col-md-3 flex align-start">
                        <label class="form-label" for="syn-highlight">Syntax Highlighting:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="id_syntax" id="syn-highlight" class="form-select">
                            <option value="" disabled>None</option>
                            <?php foreach ($syntaxes as $key => $syntax) :?>
                                <option value="<?=$syntax->id?>"><?=$syntax->name?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-5 col-md-3 flex align-start">
                        <label class="form-label" for="exposure">Paste Exposure:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="exposure" id="exposure" class="form-select">
                            <option value="0" selected>Public</option>
                            <option value="1">Private</option>
                        </select>
                    </div>
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
                </div>
                <div class="grid">
                    <div class="col-12 col-md-6 flex align-center">
                        <?php if (app()::isGuest()): ?>
                            <input type="hidden" name="id_user" id="id_user" value="">
                        <?php else: ?>
                            <input type="hidden" name="id_user" id="id_user" value="<?=auth()->id?>">
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
                            <img src="<?= $captchaCode ?>" alt="" id="captcha-code-image">
                        </div>
                    </div>
                <?php endif ?>
                <div class="grid">
                    <div class="col-12 col-md-3 mt-5 flex align-start">
                        <button class="btn btn-dark">Create New Paste</button>
                    </div>
                </div>
    </form>
    <?php require_once dirname(__FILE__) . "/partials/alerts/guestalert.view.php" ?>

</section>

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