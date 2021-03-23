<section class="home-section">
    <div class="row home-first">
        <div class="home-paste">
            <h4>New Paste</h4>
            <textarea name="" id="" cols="30" rows="15"></textarea>
        </div>
        <aside class="home-aside">
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
    </div>
    <div class="row">
        <h4>Optional Paste Settings</h4>
        <div>
            <form action="">
                <div class="form-group">
                    <label for="">Syntax Highlighting:</label>
                    <select name="" id="" class="form-control">
                        <option value="">None</option>
                        <option value="">C++</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Paste Exposure:</label>
                    <select name="" id="" class="form-control">
                        <option value="">None</option>
                        <option value="">Public</option>
                        <option value="">Private</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for=""></label>
                    <input type="checkbox" placeholder="Burn after read" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Paste Name/Title:</label>
                    <input type="text" placeholder="Title" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Create New Paste</button>
                </div>
            </form>
            <?php include "partials/alerts/guestalert.view.php" ?>
        </div>
    </div>
</section>