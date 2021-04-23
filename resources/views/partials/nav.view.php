<nav class="navbar">
    <div class="container navbar-container">
        <a href="/" class="navbar-brand"><img src="/favicon.png" alt="" style="    width: 50px;
    height: 50px;"></a>
        <a href="/" class="btn btn-succes header-paste-btn btn-sm navbar-action-button">Paste</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/ScholarlyHtml.html" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact</a>
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
                <a href="#" class="nav-link text-danger dropdown-trigger"><?= auth()->username ?></a>
                <ul class="login-dropdown-menu">
                    <li class="login-dropdown-menu-item"><a href="/user/profile">Profile</a></li>
                    <li class="login-dropdown-menu-item"><a href="/user/settings">Settings</a></li>
                    <li class="login-dropdown-menu-item"><a href="user/mypastes">My Pastes</a></li>
                    <li class="login-dropdown-menu-item"><a href="/logout">Logout</a></li>
                </ul>
            <?php endif; ?>
        </div>
        <button class="navbar-toggler" type="button" id="nav-toggler">
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
                <li class="nav-item"
                <a href="/logout"><?= auth()->username ?></a>
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