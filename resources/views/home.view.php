<section class="home-section">
    <div class="row home-first">
        <div class="home-paste">
            <h4>New Paste</h4>
            <textarea name="" id="" cols="30" rows="15"></textarea>
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
            <form class="home-form" action="">
                <div class="grid">
                    <div class="col-6 col-md-3 flex align-start">
                        <label class="form-label" for="">Syntax Highlighting:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="" id="" class="form-select">
                            <option value="">None</option>
                            <option value="">C++</option>
                        </select>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-5 col-md-3 flex align-start">
                        <label class="form-label" for="">Paste Exposure:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <select name="" id="" class="form-select">
                            <option value="">None</option>
                            <option value="">Public</option>
                            <option value="">Private</option>
                        </select>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-md-offset-3"></div>
                    <div class="form-check col-10 col-md-8 flex align-start">
                        <input type="checkbox" class="form-check-input">
                        <label class="form-label" for="">Burn after read</label>
                    </div>
                </div>
                <div class="grid">
                    <div class="col-6 col-md-3 flex align-start">
                        <label class="form-label" for="">Paste Name/Title:</label>
                    </div>
                    <div class="col-12 col-md-6 flex align-center">
                        <input type="text" placeholder="Title" class="form-control">
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