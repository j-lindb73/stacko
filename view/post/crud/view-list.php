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



?><h1> <?= $items[0]->acronym ?></h1>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <th>Posttype</th>
        <th>ViewPost</th>
        <th>ParentPost</th>
        <th>Title</th>
        <th>Text</th>
        <th>Created</th>
    </tr>
    <?php foreach ($items as $item) : ?>

    <tr>
        <td>
            <?php if($item->postTypeId == 1) :?>
            ?
            <?php else : ?>
            !
            <?php endif; ?>
        </td>
        <td>
            <?php if($item->postTypeId == 1) :?>
            <a href="<?= url("post/view/{$item->id}"); ?>"><?= $item->id ?></a>
            <?php endif; ?>
        </td>
        <td><a href="<?= url("post/view/{$item->parentId}"); ?>"><?= $item->parentId ?></a></td>
        <td><?= $filter->doFilter($item->title, ["markdown","nl2br"]); ?></td>
        <td><?= $filter->doFilter($item->text, ["markdown","nl2br"]); ?></td>
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