<?php
$this->setTitle("Add paste vertion");
?>
<section class="paste-section">
    <form action="/paste/add-version/<?=$paste->slug ?>" method="POST">
        <div class="row">
            <input type="hidden" name="id_paste" value="<?=$paste->id ?>">
            <input type="hidden" name="id_user" value="<?= auth()->id ?>">
        </div>

        <div class="row mt-5">
            <div class="grid">

                <div class="col-12 flex align-start">
                    <h3 class="h3">Add new paste version</h3>
                </div>

                <div class="col-12">
                    <textarea name="code" id="code" cols="30" rows="10" class="paste-text-area"><?= $latestVersion->code ?? $paste->code?></textarea>
                </div>
            </div>
        </div>

        <div class="row justify-end flex">
            <a href="/" class="btn btn-danger mr-1">
                Cancel
            </a>
            <button class="btn btn-succes ">
                Save Changes
            </button>
        </div>

    </form>


</section>