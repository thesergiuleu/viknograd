<?php

use App\Page;

return [
    'pages' => [
        ['title' => 'Bсе страницы', 'ext' => 'page', 'id' => null],
        ['title' => 'Проекты', 'ext' => 'project', 'id' => Page::PROJECTS],
        ['title' => 'Наши работы', 'ext' => 'our_work', 'id' => Page::OUR_WORKS],
        ['title' => 'Новости', 'ext' => 'new', 'id' => Page::NEWS],
        ['title' => 'Вакансии', 'ext' => 'job', 'id' => Page::JOBS],
        ['title' => 'Контакты', 'ext' => 'contact', 'id' => Page::CONTACTS],
    ]
];
