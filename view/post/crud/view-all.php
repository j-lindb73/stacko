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



?><h1>View all items</h1>

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
        <th>Posttype</th>
        <th>ParentId</th>
        <th>Title</th>
        <th>Text</th>
        <th>Tags</th>
        <th>Created</th>
        <th>Answer</th>
    </tr>
    <?php foreach ($items as $item) : ?>

    <tr>
        <td>
            <a href="<?= url("post/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $item->postTypeId ?></td>
        <td><?= $item->parentId ?></td>
        <td><?= $filter->doFilter($item->title, ["nl2br"]); ?></td>
        <td><?= $item->text ?></td>
        <td>n/a</td>
        <td><?= $item->created ?></td>
        <td> <?= generateLink($urlToAnswer, $item->postTypeId, $item->id) ?></td>
        <td><a href="<?= url("comment/create/{$item->id}"); ?>">Comment</a></td>

    </tr>
    <?php endforeach; ?>
</table>

<?php
function generateLink($urlToAnswer, $postTypeId, $id)
{
    $link = "";
    if ($postTypeId == 1) {

        $link = "<a href=" . $urlToAnswer . '?id=' . $id . ">Answer</a>";
    }
    return $link;
}