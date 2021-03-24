<section class="home-section">
    <div class="row home-first">
        <div class="home-paste">
            <h4>New Paste</h4>
            <textarea name="paste" id="pasteit" cols="30" rows="15"></textarea>
        </div>
        <aside class="home-aside sm-hidden">
            <h4>Public Pastes</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="">Lorem</a>
                    <span>C++ | 33sec ago</span>
                </li>
                <li class="list-group-item">
                    <a href="">Lorem</a>
                    <span>C++ | 33sec ago</span>
                </li>
                <li class="list-group-item">
                    <a href="">Lorem</a>
                    <span>C++ | 33sec ago</span>
                </li>
                <li class="list-group-item">
                    <a href="">Lorem</a>
                    <span>C++ | 33sec ago</span>
                </li>
            </ul>
        </aside>
    </div>
    <div class="row">
        <h4 class="section-title">Optional Paste Settings</h4>
        <div>
            <form class="home-form" action="/paste" method="POST">
                <div class="grid">
                    <div class="col-6 col-md-3 flex align-start">
                        <label class="form-label" for="syn-highlight">Syntax Highlighting:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="syn-highlight" id="syn-highlight" class="form-select">
                            <option value="">None</option>
                            <option value="">C++</option>
                        </select>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-5 col-md-3 flex align-start">
                        <label class="form-label" for="exposure">Paste Exposure:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="exposure" id="exposure" class="form-select">
                            <option value="">None</option>
                            <option value="">Public</option>
                            <option value="">Private</option>
                        </select>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-md-offset-3"></div>
                    <div class="form-check col-10 col-md-8 flex align-start">
                        <input type="checkbox" class="form-check-input" name="burn" id="burn">
                        <label class="form-label" for="burn">Burn after read</label>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-6 col-md-3 flex align-start">
                        <label class="form-label" for="title">Paste Name/Title:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <input type="text" placeholder="Title" class="form-control" name="title" id="title">
                    </div>
                </div>
                <div class="grid">
                    <div class="col-12 col-md-3 mt-5 flex align-start">
                        <button class="btn btn-dark">Create New Paste</button>
                    </div>
                </div>
            </form>
            {{login-alert}}
        </div>
    </div>
</section>