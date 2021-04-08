<div class="flex">
    <section class="section">
        <div class="row">
            <h4 class="section-title mb-2 h4">My Profile</h4>
            <div class="settings-content">
                <form class="home-form" action="/user/settings" method="POST">
                    <div class="grid">
                        <div class="col-6 col-md-3 flex align-start">
                            <label class="form-label" for="syn-highlight">Username : </label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <input type="text" name="username" class="form-control" id="syn-highlight" placeholder="username"/>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Email Adress: </label>
                        </div>
                        <div class="col-12 col-md-6 flex align-center">
                            <input type="text" name="email" class="form-control" id="exposure" placeholder="email"/>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Email Status : </label>
                        </div>
                        <div class="col-7 col-md-6 flex align-center">
                           <h5 class="h5"> Verified !</h5>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="col-4 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Avatar : </label>
                        </div>
                        <div class="col-1 col-md-3 flex align-start" >
                            <img class="profile-img" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="user icon"/>
                        </div>
                        <div class="col-6 col-md-4 flex align-start">
                            <h6 class="h6"><a class="btn-link" href="#" > [ Change avatar ] </a></h6>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Account Type : </label>
                        </div>
                        <div class="col-7 col-md-6 flex align-center">
                            <h5 class="h5"> Free !</h5>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-5 col-md-3 flex align-start">
                            <label class="form-label" for="exposure">Theme : </label>
                        </div>
                        <div class="col-7 col-md-6 flex align-center">
                            <img src="/img/svg/sun.svg" alt="Sun" />
                            <input class="swipe-btn" type="checkbox" name="dark-mode" id="theme-mode" <?= $isInputChecked ? 'checked' : '' ?> />
                            <img src="/img/svg/moon.svg " alt="Moon" />
                        </div>
                    </div>

                    <div class="grid">
                        <div class="col-12 col-md-3 mt-5 flex align-start">
                            <button class="btn btn-dark">Update Settings</button>
                        </div>
                    </div>
                </form>

                <?php include("../resources/views/partials/related-links.view.php")?>

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

<script>

    function setThemeCookie(e) {
        let event = new Event("theme-changed");
        event.initEvent('theme-changed', true, true);
        document.cookie = "theme=;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";

        let body = document.getElementsByTagName('body')[0];
        let currentTheme = body.classList[0];
        console.log(currentTheme);
        if (e.target.checked  && currentTheme === 'light') {
            document.cookie = "theme=dark;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        } else if (e.target.checked  && currentTheme === 'dark') {
            document.cookie = "theme=light;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        }else if (!e.target.checked  && currentTheme === 'light'){
            document.cookie = "theme=dark;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        }else if (!e.target.checked  && currentTheme === 'dark'){
            document.cookie = "theme=light;expires=Thu, 18 Dec 2021 12:00:00 UTC;path=/";
        }
        body.dispatchEvent(event);
    }

    function changeTheme(e) {
        let cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            if (cookies[i].split('=')[0].trim() === 'theme') {
                let themeValue = cookies[i].split('=')[1];
                e.target.classList = '' + themeValue;
            }
        }


    }

    document.getElementById('theme-mode')?.addEventListener('click', setThemeCookie);

    document.getElementsByTagName('body')[0].addEventListener('theme-changed', changeTheme);

</script>


