<div class="flex">
    <section class="section">
        <div class="row">
            <h4 class="section-title mb-2 h4">My Settings</h4>
            <div class="settings-content">
                <form class="home-form" action="/user/settings" method="POST">
                    <div class="grid">
                        <div class="col-6 col-md-3 flex align-start">
                            <label class="form-label" for="syn-highlight">Default Syntacs:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <select name="syn-highlight" id="syn-highlight" class="form-select">
                                <option value="">None</option>
                                <option value="">C++</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-7 col-md-3 flex align-start">
                            <label class="form-label" for="exposure1">Default Expiration:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <select name="exposure" id="exposure1" class="form-select">
                                <option value="">Never</option>
                                <option value="">Burn after read</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-7 col-md-3 flex align-start">
                            <label class="form-label" for="exposure2">Default Exposure:</label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <select name="exposure" id="exposure2" class="form-select">
                                <option value="">None</option>
                                <option value="">Public</option>
                                <option value="">Private</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-12 col-md-3 mt-5 flex align-start">
                            <button class="btn btn-dark">Update Settings</button>
                        </div>
                    </div>
                </form>

                <aside class="related-links">
                    <h4 class="h4">Account related pages</h4>
                    <ul class="quick-links-list quick-links-list-light">
                        <li class="quick-link-item">
                            <a class="quick-link" href="/user/profile">Profile</a>
                        </li>
                        <li class="quick-link-item">
                            <a class="quick-link" href="/user/settings">Settings</a>
                        </li>
                        <li class="quick-link-item">
                            <a class="quick-link" href="/user/delete">Delete account</a>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>

    </section>


    <aside class="home-aside sm-hidden settings-aside">
        <h4 class="h4">Public Pastes</h4>
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


