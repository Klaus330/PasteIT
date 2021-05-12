<section class="paste-section">
    <form action="/pastes/update/<?=$paste->slug ?>" method="POST">
        <div class="row">
            <div class="grid">
                <div class="col-5 col-md-3 flex align-start">
                    <label class="form-label" for="exposure">Paste Exposure:</label>
                </div>
                <div class="col-12 col-md-6 flex align-center">
                    <select name="exposure" id="exposure" class="form-select">
                        <option value="" >None</option>
                        <option value="" <?= $paste->exposure == 0 ? "selected" : '' ?>>Public</option>
                        <option value="" <?=$paste->exposure == 1 ? "selected" : '' ?>>Private</option>
                    </select>
                </div>
            </div>



            <div class="grid">
                <div class="col-5 col-md-3 flex align-start">
                    <label class="form-label" for="exposure">Syntax Highligth:</label>
                </div>
                <div class="col-12 col-md-6 flex align-center">
                    <select name="id_syntax" id="id_syntax" class="form-select">
                        <option value="" >None</option>
                        <?php foreach ($syntaxes as $key => $syntax) :?>
                            <option <?= $syntax->id == intval($paste->id_syntax) ? "selected" : '' ?> value="<?=$syntax->id?>"><?=$syntax->name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="grid">
                <div class="col-md-3 flex align-start">
                    <label class="form-label" for="password">Password:</label>
                </div>
                <div class="col-md-6 col-12">
                    <div class="col-md-9  flex align-center">
                        <input type="checkbox" class="form-check-input" name="password-allow" id="password-allow" <?=$paste->password != "" ? "checked" : '' ?>>
                        <label class="form-label" for="password-allow" id="passworda-allow-label">Disabled</label>
                    </div>
                    <div class="col-md-6 col-12">
                        <input type="text" placeholder="Password" class="form-control" name="password" id="password" value="<?=$paste->password?>">
                    </div>
                </div>
            </div>

            <div class="grid">
                <div class="col-md-offset-3"></div>
                <div class="form-check col-10 col-md-8 flex align-start">
                    <input type="checkbox" class="form-check-input" name="burn" id="burn" <?=$paste->burn_after_read != 0 ? "checked" : '' ?>>
                    <label class="form-label" for="burn">Burn after read</label>
                </div>
            </div>
            <div class="grid">
                <div class="col-6 col-md-3 flex align-start">
                    <label class="form-label" for="title">Paste Name/Title:</label>
                </div>
                <div class="col-12 col-md-6 flex align-center">
                    <input type="text" placeholder="Title" class="form-control" name="title" id="title" value="<?=$paste->title?>">
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="grid">

                <div class="col-12 flex align-start">
                    <h3 class="h3">Edit paste</h3>
                </div>

                <div class="col-12">
                    <textarea name="code" id="code" cols="30" rows="10" class="paste-text-area"><?=$paste->code?></textarea>
                </div>
            </div>
        </div>

        <div class="row justify-end flex">
            <button class="btn btn-succes mr-1">
                Save Changes
            </button>
            <a href="/" class="btn btn-danger">
                Cancel
            </a>
        </div>

    </form>


</section>