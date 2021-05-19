<section class="paste-section">
    <h2>Version</h2>
    <div class="home-first">

        <div class="grid">
            <div class="highlight-container col-12">
                <div class="highlight-pre">
                    <div class="source-code">
                        <pre class="source-pre">
                            <code class="source <?= $paste->syntax()->name?>"><?= $version->code ?></code>
                        </pre>
                    </div>
                </div>
            </div>
            <div class="col-3 flex">
                <a href="/paste/versions/<?= $paste->slug?>" class="btn btn-primary mr-1">Inapoi</a>
                <form action="/versions/promote/<?= $version->slug ?>" method="POST">
                    <button class="btn btn-info">Promote</button>
                </form>
            </div>
        </div>
    </div>
</section>