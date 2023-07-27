<?php

namespace NITSAN\NsNewsAuthor\Domain\Repository;

/**
 * The repository for NewsAuthors
 */
class NewsAuthorRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    protected $defaultOrderings = array(
        'lastname' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );

    /**
     * Get authors according to the initial of the lastname
     *
     * @param string $initial Initial of lastname
     * @return QueryInterface
     */
    public function getAuthorsByInitial($initial)
    {
        if (empty($initial)) {
            throw new \InvalidArgumentException('No initial for lastname given.', 1496613849);
        }

        $query = $this->createQuery();

        $query->matching(
            $query->logicalAnd(
                $query->like('lastname', $initial . '%')
            )
        );

        return $query->execute();
    }

    /**
     * Get authors according to categories
     *
     * @param string $categories Comma separated UIDs of categories
     * @param string $initial Initial of lastname
     * @return QueryInterface
     */
    public function getAuthorsByCategories($categories = '', $initial = '')
    {
        if (empty($categories)) {
            throw new \InvalidArgumentException('No categories given.', 1494071855);
        }

        $constraint = array();
        $query = $this->createQuery();

        if (!is_array($categories)) {
            $categories = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $categories, true);
        }

        foreach ($categories as $category) {
            $categoryConstraints[] = $query->contains('categories', $category);
        }

        $constraint[] = $query->logicalOr($categoryConstraints);

        if (!empty($initial)) {
            $constraint[] = $query->logicalAnd(
                $query->like('lastname', $initial . '%')
            );
        }

        if (!empty($constraint)) {
            $query->matching(
                $query->logicalAnd($constraint)
            );
        }

        return $query->execute();
    }

}
