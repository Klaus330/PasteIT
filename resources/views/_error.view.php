<?php
    /***
    * @var $exception \Exception
    */
?>
<div class="errors">
    <p class="error-code">
        <?=$exception->getCode()?>
    </p>
    <p class="error-description"><span aria-hidden="true"><?= $exception->getMessage() ?></span><?= $exception->getMessage() ?><span aria-hidden="true"><?= $exception->getMessage() ?></span>
    </p>
</div>