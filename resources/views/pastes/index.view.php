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
                        <?= date("Y-m-d", strtotime($paste->created_at)) ?>
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
                                <span id="views">
                                    <?= $paste->nr_of_views ?>
                                </span>
                            </div>
                        </div>

                        <?php if (session()->has('user') && $paste->canEdit(auth()->id)): ?>
                            <div class="paste-actions">
                                <div class="edit">
                                    <a href="/paste/versions/<?= $paste->slug ?>">
                                        <img src="/img/svg/versions.svg" alt="versions"/>
                                    </a>
                                </div>
                                <div class="edit">
                                    <a href="
                                    <?php
                                        if($paste->isOwner(auth()->id)){
                                            echo "/pastes/edit/$paste->slug";
                                        }else{
                                            echo "/paste/add-version/$paste->slug";
                                        }
                                    ?>">
                                        <img src="/img/svg/edit.svg" alt="edit"/>
                                    </a>
                                </div>
                                <?php if($paste->isOwner(auth()->id)): ?>
                                <div class="delete">
                                    <form action="/paste/delete/<?= $paste->slug ?>" method="post">
                                        <button class="btn">
                                            <img src="/img/svg/delete.svg" alt="delete"/>
                                        </button>
                                    </form>
                                </div>
                                <?php endif; ?>
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
                            <a class="btn-toolbar" href="/paste/raw/<?= $paste->slug ?>">raw</a>
                            <a class="btn-toolbar" href="#">download</a>
                        </div>

                    </div>
                    <div class="highlight-pre">
                        <div class="source-code">
                            <pre class="source-pre">
                                <code id="source" class="source <?= strtolower($paste->syntax()->name) ?>"><?= $latestVersion->code ?? $paste->code ?></code>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="grid">

                <div class="col-12 flex align-start">
                    <label for="raw-data" class="h3">RAW Paste data</label>
                </div>

                <div class="col-12">
                    <textarea name="raw-data" id="raw-data" cols="30" rows="10"
                              class="paste-text-area"><?= $latestVersion->code ?? $paste->code ?></textarea>
                </div>

            </div>
        </div>
        <?php if (session()->has('user') && $paste->isOwner(auth()->id)): ?>
            <div class="row">
                <div class="grid">
                    <div class="col-12 col-md-12">
                        <form action="/paste/add-editor/<?= $paste->id ?>" method="POST" class="grid">
                            <div class="col-6  flex align-start justify-start flex-column">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Give access to edit">
                                <button class="btn btn-primary mt-2"> Give Access</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>


    <aside class="home-aside sm-hidden settings-aside">
        <h4 class="h4">Public Pastes</h4>
        <ul class="list-group">
            <?php foreach ($latestPastes as $publicPaste): ?>
                <li class="list-group-item">
                    <a href="/paste/view/<?= $publicPaste->slug ?>"><?= $publicPaste->title ?></a>
                    <span><?= $publicPaste->syntax()->name ?> | <?= $publicPaste->timeSinceCreation() ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

</div>

<script src="/js/highlight/patterns/<?= strtolower($paste->syntax()->name);?>.js"></script>
<script src="/js/highlight/SyntaxHighlight.js"></script>
<script>

    window.addEventListener("load", () => {
        let sourceCode = document.getElementById("source");
        let patternName = "<?= strtolower($paste->syntax()->name);?>";
        let syntax = new SyntaxHighlither();
        console.log(syntax);
        syntax.setLanguage(patternName,pattern);
        syntax.highlight(sourceCode,patternName);


    });


    function updateViews(){
        let request = new XMLHttpRequest();

        let url = '/pastes/update-views/<?= $paste->slug?>';
        request.open("POST", url, true);
        request.responseType="json";

        request.onreadystatechange = function (){
            if (this.readyState === 4 && this.status === 200) {
                let response = request.response;
                let viewsSpan = document.getElementById("views");
                viewsSpan.innerText = response.views;
            }
        };
        request.send();
    }
    updateViews();
</script>