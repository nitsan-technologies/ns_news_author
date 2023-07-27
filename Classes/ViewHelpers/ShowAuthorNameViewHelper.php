<?php
namespace NITSAN\NsNewsAuthor\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
/**
 * ShowAuthorNameViewHelper
 */
class ShowAuthorNameViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('author', 'object', 'the author object', true);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    )
    {
        if (!is_object($arguments['author'])) {
            return '';
        }

        $author = $arguments['author'];

        $authorTitle = $author->getTitle();
        $fullAuthor = $author->getFirstname().' '.$author->getLastname();

        if ($authorTitle) {
            $fullAuthor = $authorTitle.' '.$fullAuthor;
        }

        return $fullAuthor;
    }
  
}
