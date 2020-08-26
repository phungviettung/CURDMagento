<?php

namespace AHT\Example1\Controller\Index;

use Magento\Framework\App\Action\Action as Action;
use Magento\Framework\View\Result\PageFactory as PageFactory;
use Magento\Framework\App\Action\Context as Context;

class HelloWorld extends Action
{
    protected $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {

        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
