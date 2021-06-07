<?php
$this->setTitle("$paste->title - Versions");
?>
<section class="paste-section">
    <h2 class="text-color">Versions for <a href="/paste/view/<?= $paste->slug ?>"><?= $paste->title ?></a></h2>

    <div class="version-table">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Editor</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($versions as $version): ?>
                <tr>
                    <td><?= $version->editor()->username ?></td>

                    <td><?= date("Y-m-d H:i:s", strtotime($version->created_at)); ?></td>
                    <td><?= date("Y-m-d H:i:s", strtotime($version->updated_at)); ?></td>
                    <td class="flex">
                        <a href="/paste/version/<?= $version->slug ?>" class="btn btn-primary mr-1">View</a>
                        <form action="/versions/delete/<?= $version->slug ?>" method="POST">
                            <button class="btn-danger btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</section>
