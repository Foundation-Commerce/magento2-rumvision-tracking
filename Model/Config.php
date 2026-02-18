<?php
declare(strict_types=1);

namespace FoundationCommerce\RumvisionTracking\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public const XML_PATH_ENABLED = 'rumvision_tracking/general/enabled';
    public const XML_PATH_SITE_ID = 'rumvision_tracking/general/site_id';
    public const XML_PATH_DOMAIN_NAME = 'rumvision_tracking/general/domain_name';

    private ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    public function getSiteId(): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_SITE_ID, ScopeInterface::SCOPE_STORE);
    }

    public function getDomainName(): string
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_DOMAIN_NAME, ScopeInterface::SCOPE_STORE);
    }
}
