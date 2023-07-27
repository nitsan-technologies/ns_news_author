<?php

/***************************************************************
 * Provide detailed information and depenencies of EXT:ns_news_author
 ***************************************************************/

$EM_CONF['ns_news_author'] = [
    'title' => '[NITSAN[ News Author',
    'description' => 'Fork of EXT:md_news_author with TYPO3 v12 + Improvement',
    'category' => 'plugin',
    'author' => 'T3: Navdeep Jethwa',
    'author_email' => 'info@nitsantech.com',
    'author_company' => 'NITSAN Technologies Pvt Ltd',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'version' => '12.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '^12.0',
            'news' => '^11.0'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
