<?php if(app()::isGuest()): ?>
<div class="alert alert-info mt-5">
    <i></i>
    <p class="p-1">
        You are currently not logged in, this means you can not edit or delete anything you paste.
        <a href="/register">Sign Up</a> or <a href="/login">Login</a>
    </p>
</div>
<?php endif; ?>