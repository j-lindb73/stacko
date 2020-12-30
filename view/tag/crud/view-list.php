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
<p>Tag is available in following posts</p>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
<?php
    return;
endif;
?>

<table>
    <tr>
        <th></th>
        <th>PostId</th>
        <th>Title</th>
        <th>Acronym</th>
        <th>User</th>

    </tr>
    <?php foreach ($items as $item) : ?>

    <tr>
        <td> <?= getGravatar($item->email) ?></td>
        <td>
            <a href="<?= url("post/view/{$item->post_id}"); ?>"><?= $item->post_id ?></a>
        </td>
        <td><?= $item->title ?></td>
        <td><?= $item->acronym ?></td>
        <td><?= $item->email ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function getGravatar( $email, $s = 40, $d = 'mp', $r = 'g', $img = true, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}