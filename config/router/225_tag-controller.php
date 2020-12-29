<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Tag controller.",
            "mount" => "tag",
            "handler" => "\Lefty\Tag\TagController",
        ],
    ]
];
