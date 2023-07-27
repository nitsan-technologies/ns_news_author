<?php
defined('TYPO3') or die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use NITSAN\NsNewsAuthor\Controller\NewsAuthorController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use NITSAN\NsNewsAuthor\Updates\SwitchableControllerActionsPluginUpdater;

call_user_func(
    function () {
        /**
         * Array with available plugins and their configuration
         */
        $plugins = [
            'list' => [
                'cacheable' => 'list',
                'nonCacheable' => 'list'
            ],
            'show' => [
                'cacheable' => 'show',
                'nonCacheable' => ''
            ],
        ];

        foreach ($plugins as $plugin => $pluginOptions) {
            ExtensionUtility::configurePlugin(
                'NsNewsAuthor',
                $plugin,
                [
                    NewsAuthorController::class => $pluginOptions['cacheable'],
                ],
                // non-cacheable actions
                [
                    NewsAuthorController::class => $pluginOptions['nonCacheable'],
                ]
            );
        }

        /**
         * Add page TsConfig
         */
        ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_news_author/Configuration/TsConfig/Page/TCEFORM.tsconfig">'
        );

        /**
         * Extend ext:news
         */
        $GLOBALS['TYPO3_CONF_VARS']['EXT']['news']['classes']['Domain/Model/News'][] = 'ns_news_author';

        /**
         * Register Upgrade Wizard for migrating switchableControllerActions
         */
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['switchableControllerActionsPluginUpdater']
            = SwitchableControllerActionsPluginUpdater::class;

    }
);
