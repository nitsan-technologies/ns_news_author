<?php

namespace NITSAN\NsNewsAuthor\Controller;

use NITSAN\NsNewsAuthor\Domain\Repository\NewsAuthorRepository;
use NITSAN\NsNewsAuthor\Domain\Repository\NewsRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use Psr\Http\Message\ResponseInterface;
use NITSAN\NsNewsAuthor\Domain\Model\NewsAuthor;

/**
 * NewsAuthorController
 */
class NewsAuthorController extends ActionController
{

    /**
     * newsAuthorRepository
     *
     * @var NewsAuthorRepository
     */
    protected $newsAuthorRepository;

    /**
     * newsRepository
     *
     * @var NewsRepository
     */
    protected $newsRepository;

    /**
     * NewsAuthorController constructor.
     *
     * @param NewsAuthorRepository $newsAuthorRepository
     * @param NewsRepository $newsRepository
     */
    public function __construct(
        NewsAuthorRepository $newsAuthorRepository,
        NewsRepository $newsRepository
    ) {
        $this->newsAuthorRepository = $newsAuthorRepository;
        $this->newsRepository = $newsRepository;
    }

    /**
     * action list
     *
     * @param string $selectedLetter
     * @param int $currentPage
     * @return ResponseInterface
     */
    public function listAction($selectedLetter = "", int $currentPage = 1): ResponseInterface
    {
        
        if ($this->settings['categoriesList'] != '') {
            $newsAuthors = $this->newsAuthorRepository->getAuthorsByCategories($this->settings['categoriesList']);
        } else {
            $newsAuthors = $this->newsAuthorRepository->findAll();
        }

        $activeLetters = array();
        foreach ($newsAuthors as $author) {
            $char = mb_strtoupper(mb_substr($author->getLastname(), 0, 1, "UTF-8"));
            $activeLetters[$char] = true;
        }

        $this->view->assign('activeLetters', $activeLetters);
        $this->view->assign('selectedLetter', mb_strtoupper($selectedLetter));
        $this->view->assign('letters', explode(',', $this->settings['authorList']['letters']) );

        if (!empty($selectedLetter)) {
            if ($this->settings['categoriesList'] != '') {
                $newsAuthors = $this->newsAuthorRepository->getAuthorsByCategories($this->settings['categoriesList'], $selectedLetter);
            } else {
                $newsAuthors = $this->newsAuthorRepository->getAuthorsByInitial($selectedLetter);
            }
        }

        $this->assignPagination(
            $newsAuthors,
            $this->settings['authorList']['paginate']['itemsPerPage'],
            $this->settings['authorList']['paginate']['maximumNumberOfLinks']
        );
        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @param NewsAuthor|null $newsAuthor
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @return ResponseInterface
     */
    public function showAction(NewsAuthor $newsAuthor = null): ResponseInterface
    {
        if ($newsAuthor != null) {
            // write page title
            $pageTitle = $newsAuthor->getTitle() . ' ' . $newsAuthor->getFirstname() . ' ' . $newsAuthor->getLastname();
            $GLOBALS['TSFE']->page['title'] = $pageTitle;
            $GLOBALS['TSFE']->indexedDocTitle = $pageTitle;

            $this->view->assign('newsAuthor', $newsAuthor);

            $this->assignPagination(
                $this->newsRepository->getNewsByAuthor($newsAuthor->getUid()),
                $this->settings['authorDetail']['paginate']['itemsPerPage'],
                $this->settings['authorDetail']['paginate']['maximumNumberOfLinks']
            );
        } else {
            if ($this->settings['listPid']) {
                $uriBuilder = $this->uriBuilder;
                $uri = $uriBuilder
                    ->setTargetPageUid($this->settings['listPid'])
                    ->build();

                $this->redirectToUri($uri, 0, 308);
            }
        }
        return $this->htmlResponse();
    }

    /**
     * Assign pagination to current view object
     *
     * @param $items
     * @param int $itemsPerPage
     * @param int $maximumNumberOfLinks
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    protected function assignPagination($items, $itemsPerPage = 10, $maximumNumberOfLinks = 5)
    {
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;

        $paginator = new QueryResultPaginator(
            $items,
            $currentPage,
            $itemsPerPage
        );

        $pagination = new SimplePagination(
            $paginator,
            $maximumNumberOfLinks
        );

        $this->view->assign('pagination', [
            'paginator' => $paginator,
            'pagination' => $pagination,
        ]);
    }
}
