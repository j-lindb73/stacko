<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",
 
    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Users",
            "url" => "user",
            "title" => "Administer users.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Create",
                        "url" => "user/create",
                        "title" => "Create user.",
                    ],
                    [
                        "text" => "Login",
                        "url" => "user/login",
                        "title" => "Login user.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Posts",
            "url" => "post",
            "title" => "Administer posts.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Create",
                        "url" => "post/create",
                        "title" => "Create post.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Tags",
            "url" => "tag",
            "title" => "Show tags.",
        ],
        [
            "text" => "Comments",
            "url" => "comment",
            "title" => "Administer comments.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Create",
                        "url" => "comment/create",
                        "title" => "Create comment.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
    ],
];
