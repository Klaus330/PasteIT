<?php
$this->setTitle("Burn after read")
?>
<div class="row">
    <h4 class="section-title h4 mb-2 mt-2">Burn after read</h4>
    <div>
        <form class="home-form" action="/pastes/burn" method="POST">
            <input type="hidden" name="slug" value="<?=$slug?>">
            <div>
                <p class="burn-after-read-warning">This pastes is burn after read type. Are you sure you want to continue?</p>
            </div>

            <div class="grid">
                <div class="col-3 col-md-2 align-start flex">
                    <button class="btn btn-succes" type="submit">Yes</button>
                </div>

                <div class="col-3 col-md-2 align-end flex">
                    <a  href="/" class="btn btn-danger">No</a>
                </div>

            </div>
        </form>
    </div>
</div>

<script>

</script>
