<div class="flex">
    <section class="section">
        <div class="row">
            <h4 class="section-title mb-2 h4">My Settings</h4>
            <div class="settings-content">
                <form class="home-form" action="/user/settings" method="POST">
<!--                    <input type="hidden" name="id_user" value="--><?php //echo $userId ?><!--">-->
                    <div class="grid">
                        <div class="col-6 col-md-3 flex align-start">
                            <label class="form-label" for="syn-highlight">Default Syntacs:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <select name="id_syntax" id="syn-highlight" class="form-select">
                                <option value="">None</option>
                                <option value="1">C++</option>
                                <option value="2">Java</option>
                                <option value="3">Html</option>
                            </select>
                        </div>

                        <div class="col-12 flex align-start">
                            <span class="text-danger"">
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
                                <option value="">Never</option>
                                <option value="burn">Burn after read</option>
                            </select>
                        </div>
                        <div class="col-12 flex align-start">
                            <span class="text-danger"">
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
                                <option value="">None</option>
                                <option value="0">Public</option>
                                <option value="1">Private</option>
                            </select>
                        </div>
                        <div class="col-12 flex align-start">
                            <span class="text-danger"">
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
                    <a href="/paste/<?= $paste->slug ?>"><?= $paste->title ?></a>
                    <span><?= $paste->syntax()->name ?> | <?= $paste->user()->username ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

</div>


