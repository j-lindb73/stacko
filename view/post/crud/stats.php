<?php

namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
// var_dump($items);
// var_dump($answers);
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("post/create");
$urlToDelete = url("book/delete");
$urlToAnswer = url("post/create");
$urlToComment = url("comment/create");



?><h1>Latest posts</h1>


<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <th>Post</th>
        <th>Type</th>
        <th>Title</th>
        <th>Created</th>


    </tr>
    <?php foreach ($items as $item) : ?>

    <tr>
        <td>
            <a href="<?= url("post/view/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td>
            <?php if($item->postTypeId == 1) :?>
            ?
            <?php else : ?>
            !
            <?php endif; ?>
        </td>
        <td><?= $filter->doFilter($item->title, ["markdown", "nl2br"]) ?></td>
        <td><?= $item->created ?></td>

    </tr>
    <?php endforeach; ?>
</table>

<p>
    <a href="<?= $urlToCreate ?>">Create post</a>
</p>
