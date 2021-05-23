<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->getTitle()  ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/favicon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
<!--    <link rel="stylesheet"-->
<!--          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/styles/default.min.css">-->
<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"></script>-->
</head>
<body class="<?php echo (array_key_exists('theme', $_COOKIE) ?  $_COOKIE['theme'] : 'light') ?>">
    {{nav}}

    <main class="container">
        <?php if(session()->hasFlash('success')): ?>
            <div class="alert alert-success notification">
                <?= session()->getFlash('success')?>
            </div>
        <?php elseif (session()->hasFlash("danger")): ?>
            <div class="alert alert-danger notification">
                <?= session()->getFlash('danger')?>
            </div>
        <?php endif;?>
        {{content}}
    </main>

    {{footer}}
<script src="/js/script.js"></script>
</body>
</html>
