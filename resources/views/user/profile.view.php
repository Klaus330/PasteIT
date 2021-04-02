<section class="flex">
    <section class="section">
        <div class="row">
            <h4 class="section-title mb-2">My Profile</h4>
            <div class="settings-content">
                <form class="home-form" action="/user/settings" method="POST">
                    <div class="grid">
                        <div class="col-6 col-md-3 flex align-start">
                            <label class="form-label" for="syn-highlight">Username : </label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <input type="text" name="username" class="form-control" id="username" placeholder="username"/>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Email Adress: </label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <input type="text" name="email" class="form-control" id="email" placeholder="email"/>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Email Status : </label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                           <h5> Verfied !</h5>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-4 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Avatar : </label>
                        </div>
                        <div class="col-1 col-md-2 flex align-start" >
                            <img class="profile-img" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="user icon"/>
                        </div>
                        <div class="col-6 col-md-4 flex align-start">
                            <h5><a class="btn-link" href="#" > [ Change avatar ] </a></h5>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Account Type : </label>
                        </div>
                        <div class="col-7 col-md-6 flex align-center">
                            <h5> Free !</h5>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Theme : </label>
                        </div>
                        <div class="col-7 col-md-6 flex align-center">
                            <img src="/img/svg/sun.svg" />
                            <input class="swipe-btn" type="checkbox" name="dark-mode" id="dark-mode"  />
                            <img src="/img/svg/moon.svg " />
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-12 col-md-3 mt-5 flex align-start">
                            <button class="btn btn-dark">Update Settings</button>
                        </div>
                    </div>
                </form>

                <aside class="related-links">
                    <h4>Account related pages</h4>
                    <ul class="quick-links-list">
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

</section>


