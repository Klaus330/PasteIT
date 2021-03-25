<div class="row">
    <h1>Reset password</h1>
    <div class="row">
        <form class="login-form simple-form" action="/reset-password" method="POST">
            <div class="grid mt-2">
                <div class="col-md-4 col-4">
                    <label for="password" class="form-label">
                        Password:
                    </label>
                </div>
                <div class="col-md-8 col-12">
                    <input type="password" name="password" class="form-control" id="password" placeholder="password"/>
                </div>
            </div>

            <div class="grid mt-2">
                <div class="col-md-4 col-4">
                    <label for="confirm-password" class="form-label">
                        Confirm password:
                    </label>
                </div>
                <div class="col-md-8 col-12">
                    <input type="password" name="confirm-password" class="form-control" id="confirm-password" placeholder="confirm password"/>
                </div>
            </div>
            <div class="form-group mt-2 login-buttons">
                <button type="submit" class="btn btn-primary">
                    Reset
                </button>

            </div>

        </form>
    </div>
</div>
