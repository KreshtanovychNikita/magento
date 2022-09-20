<?php
declare(strict_types=1);

namespace Slark\StoreLocator\Model;

//use Magento\Tests\NamingConvention\true\string;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\Collection;

class VerificationUrl
{
    /**
     * @param Collection $collection
     */
    public function __construct(
        Collection $collection
    ) {
        $this->collection = $collection;
    }

    /**
     * @param string $url
     * @return string|bool
     */
    public function checkUrlKeys(string $url)
    {
        $data = $this->collection->load()->getData();
        foreach ($data as $item) {
            if ($item['url_key'] === $url) {
                return $item['entity_id'];
            }
        }
        return false;
    }

    /**
     * @param $url
     * @return bool
     */
    public function checkUniqueUrl($url): bool
    {
        $data = $this->collection->load()->getData();
        foreach ($data as $item) {
            if ($item['url_key'] === $url) {
                return false;
            }
        }
        return true;
    }

    public function newUrl($autoUrl, $url): bool
    {
        if (($autoUrl) === $url) {
            return false;
        }
        return true;
    }
}
