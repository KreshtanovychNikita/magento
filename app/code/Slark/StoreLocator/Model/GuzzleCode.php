<?php

namespace Slark\StoreLocator\Model;

use GuzzleHttp\Exception\GuzzleException;
use Laminas\Db\ConfigProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class GuzzleCode
{
    public const API_KEY = 'slark_store_locator/general/locator_api';

    public function __construct(
        ConfigProvider $configProvider,
        ScopeConfigInterface $scopeConfig,
        \GuzzleHttp\ClientFactory $clientFactory
    ) {
        $this->configProvider = $configProvider;
        $this->scopeConfig = $scopeConfig;
        $this->clientFactory = $clientFactory;
    }

    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    public function getCord(string $addres)
    {
        $apiKey= $this->scopeConfig->getValue(self::API_KEY, ScopeInterface::SCOPE_STORE);
        $client = $this->clientFactory->create();
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($addres) . '&key=' . $apiKey);
//        var_dump($apiKey);
//        die;

//        print_r((string)$response->getBody());
//        die;
        $geo= json_decode((string)$response->getBody(), false, 512, JSON_THROW_ON_ERROR);
//        print_r($geo);
//        die;
//        $coordinates[0] = $geo->results[0]->geometry->location['lat'];
//        $coordinates[1] = $geo->results[0]->geometry->location['lng'];
//        $coordinates = ['lat' => '', 'lng' => ''];
        if (isset($geo->results[0])) {
            $coordinates = (array)$geo->results[0]->geometry->location;
        }
//        var_dump($location);
//        die;
//        $geo= json_decode((string)$response->getBody(), false, 512, JSON_THROW_ON_ERROR);
//        $coordinates[0] = $geo['results'][0]['geometry']['location']['lat'];
//        $coordinates[1] = $geo['results'][0]['geometry']['location']['lng'];
        return  $coordinates;
    }
}
