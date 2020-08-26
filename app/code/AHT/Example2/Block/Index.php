<?php

namespace AHT\Example2\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    private $postFactory;
    private $postRepository;

    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
                                \AHT\Example2\Model\BlogPostRepository $postRepository,
                                \AHT\Example2\Model\BlogPostFactory $postFactory
    )
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }

    public function getBlogInfo()
    {
        return __('AHT Blog module');
    }

    public function getPosts()
    {
        $collection = $this->postRepository->getList();
        // $collection = $post->getCollection();
        return $collection;
    }

}
