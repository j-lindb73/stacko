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
$urlToView = url("post/view");



?><h1>View all items</h1>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Parent</th>
    </tr>
    <?php foreach ($items as $item) : ?>

    <tr>
        <td>
            <a href="<?= url("comment/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $filter->doFilter($item->body, ["markdown"]); ?></td>
        <td><?= $item->created ?></td>
        <td><a href='<?= $urlToView . "/" . $item->parentId ?>'><?= $item->parentId ?></a></td>


    </tr>
    <?php endforeach; ?>
</table>
