<?php
?>


<section class="section">
    <div class="row">

        <div class="grid">
            <div class="col-12 flex justify-between align-center">
                <div class=" flex align-center ">
                    <img src="<?= !empty($user->avatar) ? auth()->avatar : 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50' ?>"
                         alt="user icon" class="profile-img">
                    <h2 class="p-1"><?= $user->username ?>'s profile</h2>
                </div>
                <?php if(auth()->isAdmin()): ?>
                    <div>
                        <form action="/ban/user/<?= $user->id ?>" method="POST">
                            <button class="btn btn-danger">Ban this user</button>
                        </form>
                    </div>
                <?php else:?>
                    <div>
                        <a href="/contact?user=<?=$user->username?>" class="btn btn-dark">Report Abuse</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-12">
                <div class="cards-container">
                    <?php foreach ($usersPastes as $paste): ?>
                        <div class="card">
                            <span class="card-blocks">
                            </span>
                            <div class="card-content">
                                <h2 class="card-title h2"><?= $paste->title ?></h2>
                                <p class="card-author"><?= $paste->syntax()->name ?>
                                    (<?= $paste->exposure === "1" ? "Private" : "Public" ?><?= $paste->expired === "1" ? " - expired" : "" ?>
                                    )</p>
                                <a class="btn btn-light btn-sm" href="/paste/view/<?= $paste->slug ?>">Read More</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>