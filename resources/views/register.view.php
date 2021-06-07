<?php
$this->setTitle("Register");
?>
<form action="/register" method="POST">
    <div>
        <label for="">Username</label>
        <input type="text" name="username">
    </div>

    <div>
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    <div>
        <button>Submit</button>
    </div>
</form>