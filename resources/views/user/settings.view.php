<div class="flex">
    <section class="section">
        <div class="row">
            <h4 class="section-title mb-2 h4">My Settings</h4>
            <div class="settings-content">
                <form class="home-form" action="/user/settings" method="POST">
                    <div class="grid">
                        <div class="col-6 col-md-3 flex align-start">
                            <label class="form-label" for="syn-highlight">Default Syntacs:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <select name="id_syntax" id="syn-highlight" class="form-select">
                                <?php foreach ($syntaxes as $key => $syntax) :?>
                                    <option value="<?=$syntax->id?>" <?=  $settings->id_syntax == $syntax->id ? 'selected' : '' ?> ><?=$syntax->name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-12 flex align-start">
                            <span class="text-danger">
                            <?php
                            if($errors != [])
                            {
                                echo $errors["id_syntax"][0];
                            }
                            ?>
                            </span>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-7 col-md-3 flex align-start">
                            <label class="form-label" for="exposure1">Default Expiration:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <select name="expiration" id="exposure1" class="form-select">
                                <option value="never" <?=  $settings->expiration == 'Never' ? 'selected' : '' ?>>Never</option>
                                <option value="1 min" <?=  $settings->expiration == '1 min' ? 'selected' : '' ?>>1 Minutes</option>
                                <option value="10 min" <?=  $settings->expiration == '10 min' ? 'selected' : '' ?>>10 Minutes</option>
                                <option value="1 hour" <?=  $settings->expiration == '1 hour' ? 'selected' : '' ?>>1 Hour</option>
                                <option value="1 day" <?=  $settings->expiration == '1 day' ? 'selected' : '' ?>>1 Day</option>
                                <option value="1 week" <?=  $settings->expiration == '1 week' ? 'selected' : '' ?>>1 Week</option>
                                <option value="1 month" <?=  $settings->expiration == '1 month' ? 'selected' : '' ?>>1 Month</option>
                                <option value="1 year" <?=  $settings->expiration == '1 year' ? 'selected' : '' ?>>1 Year</option>
                            </select>
                        </div>
                        <div class="col-12 flex align-start">
                            <span class="text-danger">
                            <?php
                            if($errors != [])
                            {
                                echo $errors["expiration"][0];
                            }
                            ?>
                            </span>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-7 col-md-3 flex align-start">
                            <label class="form-label" for="exposure2">Default Exposure:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <select name="exposure" id="exposure2" class="form-select">
                                <option value="" disabled>None</option>
                                <option value="" <?=  $settings->exposure == 0? 'selected' : '' ?> >Public</option>
                                <option value="1" <?=  $settings->exposure == 1 ? 'selected' : '' ?>>Private</option>
                            </select>
                        </div>
                        <div class="col-12 flex align-start">
                            <span class="text-danger">
                            <?php
                            if($errors != [])
                            {
                                echo $errors["exposure"][0];
                            }
                            ?>
                            </span>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-12 col-md-3 mt-5 flex align-start">
                            <button class="btn btn-dark">Update Settings</button>
                        </div>
                    </div>
                </form>

                <?php include("../resources/views/partials/related-links.view.php") ?>
            </div>
        </div>

    </section>


    <aside class="home-aside sm-hidden settings-aside">
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


