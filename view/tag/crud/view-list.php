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



?><h1> <?= $tag ?></h1>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <th>Id</th>
        <th>Post</th>

    </tr>
    <?php foreach ($items as $item) : ?>

    <tr>
        <td><?= $item->id ?></td>
        <td>
            <a href="<?= url("post/view/{$item->post_id}"); ?>"><?= $item->post_id ?></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
