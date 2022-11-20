<?php
declare(strict_types=1);

namespace GhostUnicorns\UpdateCategoryMerchandiser\Cron;

use GhostUnicorns\UpdateCategoryMerchandiser\Model\Config;
use GhostUnicorns\UpdateCategoryMerchandiser\Model\UpdateCategoryMerchandiserProcess;

class UpdateCategoryMerchandiser
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var UpdateCategoryMerchandiserProcess
     */
    private $updateCategoryMerchandiserProcess;

    /**
     * @param Config $config
     * @param UpdateCategoryMerchandiserProcess $updateCategoryMerchandiserProcess
     */
    public function __construct(
        Config $config,
        UpdateCategoryMerchandiserProcess $updateCategoryMerchandiserProcess
    ) {
        $this->config = $config;
        $this->updateCategoryMerchandiserProcess = $updateCategoryMerchandiserProcess;
    }

    public function execute()
    {
        if (!$this->config->isCronEnabled()) {
            return;
        }

        $this->updateCategoryMerchandiserProcess->execute();
    }
}
