<?php

namespace AHT\Example2\Model;

use AHT\Example2\Api\BlogPostRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use AHT\Example2\Model\ResourceModel\BlogPost as ResourcePost;
use AHT\Example2\Model\ResourceModel\BlogPost\CollectionFactory as PostCollectionFactory;

class BlogPostRepository implements BlogPostRepositoryInterface
{
    protected $resource;
    protected $PostFactory;
    protected $PostCollectionFactory;
    protected $searchResultsFactory;
    private $collectionProcessor;

    public function __construct(
        ResourcePost $resource,
        BlogPostFactory $PostFactory,
        \AHT\Example2\Api\Data\BlogPostInterfaceFactory $dataPostFactory,
        PostCollectionFactory $PostCollectionFactory
    )
    {
        $this->resource = $resource;
        $this->PostFactory = $PostFactory;
        $this->PostCollectionFactory = $PostCollectionFactory;
        // $this->searchResultsFactory = $searchResultsFactory;
        // $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }


    public function save(\AHT\Example2\Api\Data\BlogPostInterface $Post)
    {
        try {
            $this->resource->save($Post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $Post;
    }

    public function getById($PostId)
    {
        $Post = $this->PostFactory->create();
        $Post->load($PostId);
        if (!$Post->getId()) {
            throw new NoSuchEntityException(__('The CMS Post with the "%1" ID doesn\'t exist.', $PostId));
        }
        return $Post;
    }

    public function getList()
    {
        $collection = $this->PostCollectionFactory->create();
        return $collection;
    }

    public function delete(\AHT\Example2\Api\Data\BlogPostInterface $Post)
    {
        try {
            $this->resource->delete($Post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Post: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($PostId)
    {
        return $this->delete($this->getById($PostId));
    }
}
