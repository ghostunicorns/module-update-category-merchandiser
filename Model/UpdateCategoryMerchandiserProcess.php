<?php
declare(strict_types=1);

namespace GhostUnicorns\UpdateCategoryMerchandiser\Model;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\ResourceModel\Category;
use Magento\VisualMerchandiser\Model\ResourceModel\Rules\CollectionFactory;
use Magento\VisualMerchandiser\Model\Rules;
use Psr\Log\LoggerInterface;

class UpdateCategoryMerchandiserProcess
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var CategoryFactory
     */
    private $categoryFactory;

    /**
     * @var Category
     */
    private $categoryResource;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param CollectionFactory $collectionFactory
     * @param CategoryFactory $categoryFactory
     * @param LoggerInterface $logger
     * @param Category $categoryResource
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        CategoryFactory $categoryFactory,
        LoggerInterface $logger,
        Category $categoryResource,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->categoryResource = $categoryResource;
        $this->categoryRepository = $categoryRepository;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
            $rules = $this->collectionFactory->create();
            $rules->addFieldToFilter('is_active', 1);
            /** @var Rules $rule */
            foreach ($rules as $rule) {
                $categoryId = $rule->getData('category_id');
                $category = $this->categoryFactory->create();
                $this->categoryResource->load($category, $categoryId);

                if (!$category->getId()) {
                    continue;
                }

                $this->categoryRepository->save($category);

                $this->logger->info(__('Update category merchandiser done for category id: %1', $categoryId));
            }
        } catch (\Exception $exception) {
            $this->logger->error(__('Update category merchandiser ERROR: %1', $exception->getMessage()));
        }
    }
}
