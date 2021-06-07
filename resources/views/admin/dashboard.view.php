<?php
?>



<section class="section">
    <h2>Lastest reports</h2>
    <div class="version-table">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Created At</th>
                <th scope="col">Reason</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= $contact->fromUsername?></td>
                    <td><?= $contact->toUsername?></td>
                    <td><?= date("Y-m-d H:i:s", strtotime($contact->created_at)); ?></td>
                    <td><a href="#" class="reason" data-report="<?=$contact->message?>">View Message</a></td>
                    <td class="flex">

                        <a href="/paste/view/<?= $contact->toPaste ?>" class="btn btn-primary mr-1">View Paste</a>
                        <form action="/report/delete/<?= $contact->id ?>" method="POST">
                            <button class="btn-danger btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</section>

<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close" id="close-button">&times;</span>
        <div>
            <p id="modal-title"></p>
        </div>
    </div>
</div>


<script>
    let buttons = document.getElementsByClassName('reason');


    for(let i=0; i<buttons.length; i++){
        buttons[i].addEventListener('click', showReason);
    }


    function showReason(event){
        let modal = document.getElementById('modal');
        let modalTitle = document.getElementById('modal-title');
        let closeButton = document.getElementById("close-button");

        closeButton.onclick = function () {
            modal.style.display = "none";
        }

        modalTitle.innerText =event.target.dataset['report']
        modal.style.display = "flex";
    }
</script>