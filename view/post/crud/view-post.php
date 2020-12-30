<?php

namespace Anax\View;
$filter = new \Anax\TextFilter\TextFilter;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
// var_dump($question);
// var_dump($questionComments);
// var_dump($items);

//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("post/create");
$urlToDelete = url("book/delete");
$urlToAnswer = url("post/create");
$urlToComment = url("comment/create");

?><h1>Post</h1>
<h3><?= $question->title ?></h3>
<p><?= $filter->doFilter($question->text, ["markdown","nl2br"]) ?></p>
<p><?= $question->acronym ?></p>

<h2>Comments</h2>
<p>
    <a href="<?= $urlToComment . '/' . $question->id ?>">Create</a>
</p>

<?php if (!$questionComments) : ?>
    <p>There are no items to show.</p>
<?php else : ?>
<table>
    <tr>
        <th>Id</th>
        <th>Comment</th>
        <th>Created</th>
    </tr>
    <?php foreach ($questionComments as $item) : ?>

    <tr>
        <td>
            <a href="<?= url("comment/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $filter->doFilter($item->body, ["nl2br"]); ?></td>
        <td><?= $item->created ?></td>

    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

<h1>Answers</h1>

<p>
    <a href="<?= $urlToCreate . '?id=' . $question->id ?>">Create</a>
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
        <td><a href="<?= url("post/view/{$item->id}"); ?>">View</a></td>

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