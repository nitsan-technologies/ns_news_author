<?php

namespace NITSAN\NsNewsAuthor\Domain\Repository;

/**
 * The repository for News
 */
class NewsRepository extends \GeorgRinger\News\Domain\Repository\NewsRepository
{
    // Ordering of result
    protected $defaultOrderings = array(
        'datetime' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    );

    public function createQuery()
    {
        $query = parent::createQuery();
        $settings = $query->getQuerySettings();
        $settings->setRespectStoragePage(false);
        $query->setQuerySettings($settings);
        return $query;
    }

    /**
     * Find news by authors uid
     * We use this to get the news records ordered by "datetime"
     *
     * @param int $authorUid Uid of author
     */
    public function getNewsByAuthor(int $authorUid)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd($query->equals('newsAuthor.uid', (int)$authorUid))
        );

        return $query->execute();
    }

}
