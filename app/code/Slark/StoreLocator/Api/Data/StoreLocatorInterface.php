<?php

namespace Slark\StoreLocator\Api\Data;

//use Magento\Tests\NamingConvention\true\string;

use Magento\Tests\NamingConvention\true\mixed;
//use Magento\Tests\NamingConvention\true\string;

interface StoreLocatorInterface
{
    const ID = 'store_id';
    const NAME = 'store_name';
    const DESC = 'description_store';
    const ADDRES = 'addres_store';
    const WORK = 'work_schedule';
    const LONGI = 'longitude';
    const LATI = 'latitude';
    const IMAGE = "image";
    const URL = "url_key";


    /**
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * @param $id
     * @return StoreLocatorInterface
     */
    public function setId($id): StoreLocatorInterface;
    /**
     * @return mixed
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return StoreLocatorInterface
     */
    public function setName(string $name): StoreLocatorInterface;

    /**
     * @return string
     */
    public function getDesc(): string;

    /**
     * @param string $desc
     * @return StoreLocatorInterface
     */
    public function setDesc(string $desc): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getAddres(): string;

    /**
     * @param string $addres
     * @return StoreLocatorInterface
     */
    public function setAddres(string $addres): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getWork(): string;

    /**
     * @param string $work
     * @return StoreLocatorInterface
     */
    public function setWork(string $work): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getLongi(): string;

    /**
     * @param string $longi
     * @return StoreLocatorInterface
     */
    public function setLongi(string $longi): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getLati(): string;

    /**
     * @param string $lati
     * @return StoreLocatorInterface
     */
    public function setLati(string $lati): StoreLocatorInterface;

    /**
     * @return string|null
     */
    public function getImage(): ?string;

    /**
     * @param string $image
     * @return StoreLocatorInterface
     */
    public function setImage(string $image) : StoreLocatorInterface;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     * @return StoreLocatorInterface
     */
    public function setUrl(string $url): StoreLocatorInterface;
}

