<?php
    /***
    * @var $exception \Exception
    */
?>
<h1 class="text-danger">
    <?= $exception->getCode()?> - <?= $exception->getMessage()?>
</h1>
