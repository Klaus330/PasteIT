<section class="paste-section">
    <form action="/change-paste-settings" method="POST">
        <div class="row">
            <div class="grid">
                <div class="col-5 col-md-3 flex align-start">
                    <label class="form-label" for="exposure">Paste Exposure:</label>
                </div>
                <div class="col-12 col-md-6 flex align-center">
                    <select name="exposure" id="exposure" class="form-select">
                        <option value="">None</option>
                        <option value="">Public</option>
                        <option value="">Private</option>
                    </select>
                </div>
            </div>

            <div class="grid">
                <div class="col-md-3 flex align-start">
                    <label class="form-label" for="password">Password:</label>
                </div>
                <div class="col-md-6 col-12">
                    <div class="col-md-9  flex align-center">
                        <input type="checkbox" class="form-check-input" name="password-allow" id="password-allow">
                        <label class="form-label" for="password-allow" id="passworda-allow-label">Disabled</label>
                    </div>
                    <div class="col-md-6 col-12">
                        <input type="text" placeholder="Password" class="form-control" name="password" id="password">
                    </div>
                </div>
            </div>

            <div class="grid">
                <div class="col-md-offset-3"></div>
                <div class="form-check col-10 col-md-8 flex align-start">
                    <input type="checkbox" class="form-check-input" name="burn" id="burn">
                    <label class="form-label" for="burn">Burn after read</label>
                </div>
            </div>
            <div class="grid">
                <div class="col-6 col-md-3 flex align-start">
                    <label class="form-label" for="title">Paste Name/Title:</label>
                </div>
                <div class="col-12 col-md-6 flex align-center">
                    <input type="text" placeholder="Title" class="form-control" name="title" id="title">
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="grid">

                <div class="col-12 flex align-start">
                    <h3 class="h3">Edit paste</h3>
                </div>

                <div class="col-12">
                    <textarea name="raw-data" id="raw-data" cols="30" rows="10" class="paste-text-area"></textarea>
                </div>

            </div>
        </div>
    </form>

    <div class="row justify-end flex">
        <button class="btn btn-succes mr-1">
            Save Changes
        </button>
        <button class="btn btn-danger">
            Cancel
        </button>
    </div>
</section>