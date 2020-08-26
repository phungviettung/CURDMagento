<?php

namespace AHT\Example2\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;
    protected $postFactory;
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\View\Result\PageFactory $pageFactory,
                                \AHT\Example2\Model\BlogPostFactory $postFactory
    )
    {
        $this->pageFactory = $pageFactory;
        $this->postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
