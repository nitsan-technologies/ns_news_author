<?php
defined('TYPO3') or die();
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
/**
 * add Context Sensitive Help (CSH)
 */
ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsnewsauthor_domain_model_newsauthor', 'EXT:ns_news_author/Resources/Private/Language/locallang_csh_tx_nsnewsauthor_domain_model_newsauthor.xlf');
ExtensionManagementUtility::addLLrefForTCAdescr('tx_news_domain_model_news', 'EXT:ns_news_author/Resources/Private/Language/locallang_csh_tx_news_domain_model_news.xlf');

/**
 * Allow author records on standard pages
 */
ExtensionManagementUtility::allowTableOnStandardPages('tx_nsnewsauthor_domain_model_newsauthor');
