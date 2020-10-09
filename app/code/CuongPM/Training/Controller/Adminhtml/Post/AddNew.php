<?php


namespace CuongPM\Training\Controller\Adminhtml\Post;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class AddNew extends \Magento\Backend\App\Action
{
    private $_pageFactory;

    /**
     * AddNew constructor.
     * @param Action\Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Post'));
        return $resultPage;
    }
}
