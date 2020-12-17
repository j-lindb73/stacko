<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Comment controller.",
            "mount" => "comment",
            "handler" => "\Lefty\Comment\CommentController",
        ],
    ]
];
