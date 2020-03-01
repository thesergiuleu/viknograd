<?php

use App\Page;

return [
    'pages' => [
        ['title' => 'Dashboard', 'ext' => 'home', 'id' => null],
        ['title' => 'Pages', 'ext' => 'page', 'id' => null],
        ['title' => 'Projects', 'ext' => 'project', 'id' => Page::PROJECTS],
        ['title' => 'Menu Items', 'ext' => 'menu_item', 'id' => null],
//        ['title' => 'Reviews', 'ext' => 'review'],
//        ['title' => 'Naratives', 'ext' => 'narative'],
//        ['title' => 'Proofs', 'ext' => 'proof'],
//        ['title' => 'Criterias', 'ext' => 'criteria'],
//        ['title' => 'Example with children', 'ext' => 'media',
//            'children' => [
//                ['title' => 'Example 1', 'ext' => '1'],
//                ['title' => 'Example 2', 'ext' => '2'],
//            ],
//        ],
    ]
];
