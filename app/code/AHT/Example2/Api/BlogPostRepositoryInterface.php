<?php

namespace AHT\Example2\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BlogPostRepositoryInterface
{
    public function save(\AHT\Example2\Api\Data\BlogPostInterface $Post);

    public function getById($PostId);

    public function delete(\AHT\Example2\Api\Data\BlogPostInterface $Post);

    public function deleteById($PostId);
}
