<div class="row">
    <h1>Login</h1>
    <div class="row">
        <form class="login-form simple-form" action="/login" method="POST">
            <div class="grid" >
                <div class="col-md-3 col-3">
                    <label for="username" class="form-label">
                        Username:
                    </label>
                </div>
                <div class="col-md-9 col-12">
                    <input type="text" name="username" class="form-control" id="username"/>
                </div>
            </div>
            <div class="grid mt-2">
                <div class="col-md-3 col-3">
                    <label for="password" class="form-label">
                        Password:
                    </label>
                </div>
                <div class="col-md-9 col-12">
                    <input type="password" name="password" class="form-control" id="password"/>
                </div>
            </div>
            <div class="form-group mt-2 login-buttons">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>

                <a href="/register" class="btn btn-dark mr-1">
                    Create new account
                </a>
            </div>
            <div class="grid">
                <div class="col-md-offset-8">
                </div>

                <div class="col-md-4">
                    <a href="/forgot-password" class="btn-link">
                        Forgot your password?
                    </a>
                </div>

            </div>

        </form>
    </div>
</div>
