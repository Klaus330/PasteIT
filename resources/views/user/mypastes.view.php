<div class="flex">
    <section class="section">
        <div class="row">
            <h4 class="section-title mb-2 h4">My Pastes</h4>
            <div class="settings-content">
                <?php if ($userPastes != []): ?>
                    <?php foreach ($userPastes as $paste): ?>
                        <div class="cards-container">

                            <div class="card">
                        <span class="card-blocks">

                        </span>
                                <div class="card-content">
                                    <h2 class="card-title h2"><?= $paste->title ?> </h2>
                                    <p class="card-author"><?= strtoupper($paste->syntax()->name) ?> (<?= $paste->isPrivate() ? "Private" : "Public"?>)</p>
                                    <a class="btn btn-light btn-sm" href="/paste/view/<?= $paste->slug ?>">Read More</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                        <p class="text-dual-color">
                            Nu sunt postari.
                        </p>
                <?php endif; ?>

            </div>
        </div>

    </section>

</div>


