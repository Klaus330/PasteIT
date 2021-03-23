<div class="row">
    <h1>Login</h1>
    <div class="row">
        <form class="login-form" action="/login" method="POST">
            <div class="form-group" >
                <label for="username" class="form-label">
                    Username:
                </label>
                <input type="text" name="username" class="form-control"/>
            </div>
            <div class="form-group mt-2">
                <label for="password" class="form-label">
                    Password:
                </label>
                <input type="password" name="password" class="form-control"/>
            </div>
            <div class="form-group mt-2 login-buttons">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>

                <a href="/register" class="btn btn-dark mr-1">
                    Create new account
                </a>
            </div>

        </form>
    </div>
</div>
