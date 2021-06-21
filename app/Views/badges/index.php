<?php if(is_array($badges)) : ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($badges as $badge) : ?>
                <tr>
                    <td><?=esc($badge["id"]);?></td>
                    <td><?=esc($badge["name"]);?></td>
                    <td><?=esc($badge["description"]);?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
<?php else : ?>

    <a id="" href="badges/view/<?=esc($badges["id"])?>"><?= esc($badges["name"]); ?></a>

<?php endif; ?>

