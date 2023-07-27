<?php

namespace NITSAN\NsNewsAuthor\Domain\Model;

/**
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News
{
    /**
     * newsAuthor
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor>
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     */
    protected $newsAuthor = null;

    /**
     * Adds a NewsAuthor
     *
     * @param \NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor $newsAuthor
     * @return void
     */
    public function addNewsAuthor(\NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor $newsAuthor)
    {
        $this->newsAuthor->attach($newsAuthor);
    }

    /**
     * Removes a NewsAuthor
     *
     * @param \NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor $newsAuthorToRemove The NewsAuthor to be removed
     * @return void
     */
    public function removeNewsAuthor(\NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor $newsAuthorToRemove)
    {
        $this->newsAuthor->detach($newsAuthorToRemove);
    }

    /**
     * Returns the newsAuthor
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor> newsAuthor
     */
    public function getNewsAuthor()
    {
        return $this->newsAuthor;
    }

    /**
     * Sets the newsAuthor
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor> $newsAuthor
     * @return void
     */
    public function setNewsAuthor(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $newsAuthor)
    {
        $this->newsAuthor = $newsAuthor;
    }

}
