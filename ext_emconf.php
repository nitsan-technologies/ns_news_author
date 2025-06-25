<?php

/***************************************************************
 * Provide detailed information and depenencies of EXT:ns_news_author
 ***************************************************************/

$EM_CONF['ns_news_author'] = [
    'title' => 'News Author for TYPO3',
    'description' => 'A modern fork of EXT:md_news_author, fully compatible with TYPO3 v12. Adds author management and associations for the TYPO3 News extension, improved with clean UI and better performance.',
    'category' => 'plugin',
    'author' => 'Team T3Planet',
    'author_email' => 'info@t3planet.de',
    'author_company' => 'T3Planet',
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
