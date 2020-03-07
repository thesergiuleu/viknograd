<?php

use App\Page;

return [
    'pages' => [
        ['title' => 'Bсе страницы', 'ext' => 'page', 'id' => null],
        ['title' => 'Проекты', 'ext' => 'project', 'id' => Page::PROJECTS],
        ['title' => 'Наши работы', 'ext' => 'our_work', 'id' => Page::OUR_WORKS],
        ['title' => 'Новости', 'ext' => 'new', 'id' => Page::NEWS],
        ['title' => 'Контакты', 'ext' => 'contact', 'id' => Page::CONTACTS],
        ['title' => 'Вакансии', 'ext' => 'job', 'id' => Page::JOBS],
//        ['title' => 'Menu Items', 'ext' => 'menu_item', 'id' => null],
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
