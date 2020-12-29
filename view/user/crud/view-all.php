<?php

namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("post/create");
$urlToDelete = url("book/delete");
$urlToAnswer = url("post/create");
$urlToComment = url("comment/create");





?><h1>View all users</h1>

<p>
    <a href="<?= $urlToCreate ?>">Create</a> | 
    <a href="<?= $urlToDelete ?>">Delete</a>
</p>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <th>Id</th>
        <th>Acronym</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>

    </tr>
    <?php foreach ($items as $item) : ?>

    <tr>
        <td>
            <a href="<?= url("post/view/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $item->acronym ?></td>
        <td><?= $item->firstname ?></td>
        <td><?= $item->lastname ?></td>
        <td><?= $item->email ?></td>
    

    </tr>
    <?php endforeach; ?>
</table>
