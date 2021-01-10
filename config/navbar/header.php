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
            "text" => "Home",
            "url" => "",
            "title" => "First page.",
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
                    [
                        "text" => "Logout",
                        "url" => "user/logout",
                        "title" => "Logout user.",
                    ],
                    [
                        "text" => "List",
                        "url" => "user/list",
                        "title" => "List users.",
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
                        "text" => "Delete",
                        "url" => "comment/delete",
                        "title" => "Delete comment.",
                    ],
                ],
            ],
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this website.",
        ],

    ],
];
