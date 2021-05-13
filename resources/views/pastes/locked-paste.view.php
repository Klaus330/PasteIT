<div class="row">
    <h4 class="section-title h4 mb-2">Locked Paste</h4>
    <div>
        <form class="home-form" action="/pastes/unlock-paste" method="POST">
            <input type="hidden" name="slug" value="<?=$paste->slug?>">
            <div class="grid">
                <div class="col-12 col-md-2 flex align-start">
                    <label class="form-label" for="password">Enter password:</label>
                </div>
                <div class="col-12 col-md-7 flex align-center mb-2">
                    <input type="password" placeholder="password" class="form-control" name="password" id="password">
                </div>
                <div class="col-12 flex align-start">
                    <?php if(session()->hasFlash("errors")): ?>
                        <p class="text-danger"><?= session()->getFlash("errors")['password']?></p>
                    <?php endif;?>
                </div>
            </div>

            <div class="grid">
                <div class="col-md-2 sm-hidden"></div>
                <div class="col-6 col-md-3 align-start flex">
                    <button class="btn btn-primary" type="submit">Unlock The Paste</button>
                </div>

                <div class="col-6 col-md-4 align-end flex justify-end">
                    <span class="btn btn-primary" id="share-btn">Copy paste link to clipboard</span>
                </div>

            </div>
        </form>
    </div>
</div>

<script>

</script>