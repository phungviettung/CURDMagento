<?php

namespace AHT\Example2\Block;

class Edit extends \Magento\Framework\View\Element\Template
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $_postRepository;
    protected $_coreRegistry;

    public function __construct(\Magento\Framework\View\Result\PageFactory $pageFactory,
                                \Magento\Framework\View\Element\Template\Context $context,
                                \AHT\Example2\Model\BlogPostFactory $postFactory,
                                \AHT\Example2\Model\BlogPostRepository $postRepository,
                                \Magento\Framework\Registry $coreRegistry)
    {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_postRepository = $postRepository;
        $this->_coreRegistry = $coreRegistry;
    }

    public function getPost()
    {
        $post_id = $this->_coreRegistry->registry('post_id');
        $post = $this->_postRepository->getById($post_id);
        return $post;
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
