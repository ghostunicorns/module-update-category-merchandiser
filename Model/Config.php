<?php
declare(strict_types=1);

namespace GhostUnicorns\UpdateCategoryMerchandiser\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    /**
     * string
     */
    protected const VISUALMERCHANDISER_OPTIONS_CRON_ENABLED = 'visualmerchandiser/options/cron_enabled';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return bool
     */
    public function isCronEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::VISUALMERCHANDISER_OPTIONS_CRON_ENABLED,
            ScopeInterface::SCOPE_WEBSITE
        );
    }
}
