<nav class="navbar">
    <div class="container navbar-container">
        <a href="/" class="navbar-brand" title="home"><img src="<?= (array_key_exists('theme', $_COOKIE) && $_COOKIE['theme'] == "dark" ?  "/favicon-black.png" : '/favicon.png') ?>" style="    width: 50px;
    height: 50px;" alt="Paste IT"></a>
        <a href="/" class="btn btn-succes header-paste-btn btn-sm navbar-action-button">Paste</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/ScholarlyHtml.html" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Report Abuse</a>
                </li>
                <li class="nav-item">
                    <a href="/" class="btn btn-succes header-paste-btn">Paste</a>
                </li>
            </ul>
        </div>
        <div class="navbar-container collapse login-nav-item-dropdown">
            <?php if (app()::isGuest()): ?>
                <a href="/login" class="btn btn-login btn-sm mr-1">Login</a>
                <a href="/register" class="btn btn-register btn-sm">Sign Up</a>
            <?php else: ?>
                <a href="#" class="nav-link nav-user-name dropdown-trigger"><?= auth()->username ?></a>
                <ul class="login-dropdown-menu">
                    <li class="login-dropdown-menu-item"><a href="/user/profile">Profile</a></li>
                    <li class="login-dropdown-menu-item"><a href="/user/settings">Settings</a></li>
                    <li class="login-dropdown-menu-item"><a href="/user/mypastes">My Pastes</a></li>
                    <?php if(auth()->isAdmin()):?>
                        <li class="login-dropdown-menu-item"><a href="/admin/dashboard">Dashboard</a></li>
                    <?php endif;?>
                    <li class="login-dropdown-menu-item"><a href="/logout">Logout</a></li>
                </ul>
            <?php endif; ?>
        </div>
        <button class="navbar-toggler" type="button" id="nav-toggler" title="menu">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-dropdown navbar-container" id="nav-dropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="/" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="/" class="nav-link">Contact</a>
            </li>

            <?php if (!app()::isGuest()): ?>
                <li class="nav-item">
                    <a href="#" class="nav-user-name"><?php echo auth()->username; ?> </a>
                </li>

                <li class="nav-item">
                    <a href="/user/profile" class="nav-link">My profile</a>
                </li>

                <li class="nav-item">
                    <a href="/user/settings" class="nav-link">Settings</a>
                </li>

                <li class="nav-item">
                    <a href="/user/mypastes" class="nav-link">My pastes</a>
                </li>
                <?php if(auth()->isAdmin()):?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">Dashboard</a>
                    </li>
                <?php endif;?>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a href="/login" class="nav-link">
                        Login
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="nav-link">
                        Register
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>