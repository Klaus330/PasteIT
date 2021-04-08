<div class="row">
    <div class="row mt-3">
        <form class="login-form simple-form" action="/contact" method="POST">
            <div class="grid">
                <div class="col-md-3 col-3">
                    <label for="name" class="form-label">
                        Name:
                    </label>
                </div>

                <div class="col-md-9 col-12">
                    <input type="text" name="name" class="form-control" id="name" placeholder="name"/>
                </div>
            </div>

            <div class="grid mt-2">
                <div class="col-md-3 col-3">
                    <label for="email" class="form-label">
                        Email:
                    </label>
                </div>
                <div class="col-md-9 col-12">
                    <input type="email" name="email" class="form-control" id="email" placeholder="email"/>
                </div>
            </div>

            <div class="grid">
                <div class="col-md-3 col-3">
                    <label class="form-label">
                        Message:
                    </label>
                </div>
                <div class="col-12 col-md-9">
                    <textarea name="message" class="contact-message" placeholder="your message"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="flex justify-end">
                    <button class="btn btn-succes">Send</button>
                </div>
            </div>

        </form>
    </div>
</div>
