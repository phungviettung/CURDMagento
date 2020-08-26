<?php

namespace AHT\Example2\Controller\Index;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $_postRepository;
    protected $_cacheTypeList;
    protected $_cacheFrontendPool;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Example2\Model\BlogPostFactory $postFactory,
        \AHT\Example2\Model\BlogPostRepository $postRepository,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_postRepository = $postRepository;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_cacheTypeList = $cacheTypeList;
        return parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->_postFactory->create();
        if (isset($_POST['createbtn'])) {
            $post->setName($_POST['name']);
            $post->setUrlKey($_POST['url']);
            $post->setContent($_POST['content']);
            $post->setStatus($_POST['status']);
            $post->setCreatedAt(date('Y-m-d H:i:s'));
            $post->setUpdatedAt(date('Y-m-d H:i:s'));
        } elseif (isset($_POST['editbtn'])) {
            $post->setId($_POST['editbtn']);
            $post->setName($_POST['name']);
            $post->setUrlKey($_POST['url']);
            $post->setContent($_POST['content']);
            $post->setStatus($_POST['status']);
            $post->setUpdatedAt(date('Y-m-d H:i:s'));
        }
        $this->_postRepository->save($post);
        $types = array('config', 'layout', 'block_html', 'collections', 'reflection', 'db_ddl', 'compiled_config', 'eav', 'config_integration', 'config_integration_api', 'full_page', 'translate', 'config_webservice', 'vertex');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        return $this->_redirect('aht_example2');
    }
}
