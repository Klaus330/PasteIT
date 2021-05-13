<div class="flex">
    <section class="paste-section">
        <div class="row">
            <div class="paste-info-content">

                <div class="paste-user-icon">
                    <img src="<?= $paste->user()->avatar ?>" alt="user icon"/>
                </div>

                <div class="paste-info">
                    <div class="paste-info-top"><h3 class="h3"><?= $paste->title ?></h3></div>
                    <div class="paste-info-bottom">
                        <div class="paste-bottom-content">
                            <div class="username">
                                <img src="/img/svg/user-icon.svg" alt="user-icon"/>
                                <a href="#"><?= $paste->user()->username ?></a>
                            </div>

                            <div class="date">
                                <img src="/img/svg/date.svg" alt="date"/>
                                <span>
                        <?= date("Y-m-d",strtotime($paste->created_at))?>
                        </span>
                            </div>

                            <div class="expire-date">
                                <img src="/img/svg/time.svg" alt="time"/>
                                <span>
                            <?= $paste->expirationTime() ?>
                        </span>
                            </div>

                            <div class="number-of-views">
                                <img src="/img/svg/view-eye.svg" alt="view-eye"/>
                                <span>
                            <?= $paste->nr_of_views ?>
                        </span>
                            </div>
                        </div>
                        <?php if ($paste->user()->id === auth()->id): ?>
                            <div class="paste-actions">
                                <div class="edit">
                                    <a href="/pastes/edit/<?= $paste->slug ?>">
                                        <img src="/img/svg/edit.svg" alt="edit"/>
                                    </a>
                                </div>
                                <div class="delete">
                                    <form action="/paste/delete/<?= $paste->slug ?>" method="post">
                                        <button class="btn">
                                            <img src="/img/svg/delete.svg" alt="delete"/>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="grid">
                <div class="highlight-container col-12">
                    <div class="toolbar">

                        <div class="">
                            <a class="btn-toolbar" href="#"><?= $paste->syntax()->name ?></a>
                        </div>

                        <div>
                            <a class="btn-toolbar" href="#">raw</a>
                            <a class="btn-toolbar" href="#">download</a>
                        </div>

                    </div>
                    <div class="highlight-pre">
                        <div class="source-code">
                            <pre class="source-pre">
                                <code class="source <?= strtolower($paste->syntax()->name)?>"><?= trim($paste->code) ?></code>
                            </pre>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="grid">

                <div class="col-12 flex align-start">
                    <h3 class="h3">RAW Paste data</h3>
                </div>

                <div class="col-12">
                    <textarea name="raw-data" id="raw-data" cols="30" rows="10"
                              class="paste-text-area"><?= $paste->code ?></textarea>
                </div>

            </div>
        </div>
    </section>


    <aside class="home-aside sm-hidden settings-aside">
        <h4 class="h4">Public Pastes</h4>
        <ul class="list-group">
            <?php foreach ($latestPastes as $paste): ?>
                <li class="list-group-item">
                    <a href="/paste/view/<?= $paste->slug ?>"><?= $paste->title ?></a>
                    <span><?= $paste->syntax()->name ?> | <?= $paste->user()->username ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

</div>

<script>hljs.initHighlightingOnLoad();</script>