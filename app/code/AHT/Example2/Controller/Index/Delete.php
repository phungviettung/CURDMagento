<?php

namespace AHT\Example2\Controller\Index;

class Delete extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_postFactory;
    protected $_postRepository;
    protected $_coreRegistry;
    private $_cacheTypeList;
    private $_cacheFrontendPool;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Example2\Model\BlogPostFactory $postFactory,
        \AHT\Example2\Model\BlogPostRepository $postRepository,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        $this->_postRepository = $postRepository;
        $this->_coreRegistry = $coreRegistry;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;

        return parent::__construct($context);
    }

    public function execute()
    {
        $post_id = $this->getRequest()->getParam('post_id');
        $this->_postRepository->deleteById($post_id);

        $types = array('config', 'layout', 'block_html', 'collections', 'reflection', 'db_ddl', 'eav', 'config_integration', 'config_integration_api', 'full_page', 'translate', 'config_webservice');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        return $this->_redirect('aht_example2');
    }
}
