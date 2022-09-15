<?php

namespace Skark\StoreLocator\Model;

use Laminas\Db\ConfigProvider;
use Slark\StoreLocator\Api\LocatorInterface;
use Magento\Tests\NamingConvention\true\string;

class GuzzleCode
{
    private ConfigProvider $configProvider;

    public function __construct(ConfigProvider $configProvider)
    {
        $this->configProvider = $configProvider;
    }

    public function getCord(string $addres): array
    {
        $apiKey = $this->configProvider->getGoogleMapsApiKey();
        $client = new \GuzzleHttp\Client();
        $result = $client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($addres) . '&key=' . $apiKey);
        if (isset($geo->status) && ($geo->status === 'OK')) {
            $coordinates[0] = $geo->results[0]->geometry->location->lat;
            $coordinates[1] = $geo->results[0]->geometry->location->lng;
        }
        return $coordinates;
    }
}
