<?php

namespace Slark\StoreLocator\UI\DataProvider\StoreLocator;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class ConfigProvider
{
    public const GOOGLE_API_KEY = 'slark/storelocator/google_api_key';

    private ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
    /**
     * @return string
     */
    public function getGoogleMapsApiKey(): string
    {
        return (string)$this->scopeConfig->getValue(
            self::GOOGLE_API_KEY,
            ScopeInterface::SCOPE_STORE
        );
    }
}
