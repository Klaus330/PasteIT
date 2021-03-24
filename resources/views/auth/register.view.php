<div class="row">
    <h1>Register</h1>
    <div class="row">
        <form class="register-form" action="/register" method="POST">
            <div class="grid">
                <div class="col-md-3 col-3">
                    <label for="username" class="form-label">
                        Username:
                    </label>
                </div>
                <div class="col-md-9 col-12 flex align-center">
                    <input type="text" name="username" placeholder="username" class="form-control" id="username"/>
                </div>
            </div>

            <div class="grid">
                <div class="col-md-3 col-3">
                    <label for="email" class="form-label">
                        Email:
                    </label>
                </div>
                <div class="col-md-9 col-12 flex align-center">
                    <input type="email" name="email" placeholder="email" class="form-control" id="email"/>
                </div>

            </div>

            <div class="grid">
                <div class="col-md-3 col-3">
                    <label for="password" class="form-label">
                        Password:
                    </label></div>
                <div class="col-md-9 col-12 flex align-center">
                    <input type="password" name="password" placeholder="password" class="form-control" id="password"/>
                </div>

            </div>
            <div class="grid">
                <div class="col-md-3 col-3">
                    <label for="confirm-password" class="form-label line-height-sm">
                        Confirm password:
                    </label>
                </div>
                <div class="col-md-9 col-12 flex align-center">
                    <input type="password" name="confirm-password" placeholder="confirm password" class="form-control" id="confirm-password"/>
                </div>

            </div>
            <div class="form-group login-buttons">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>

        </form>
    </div>
</div>