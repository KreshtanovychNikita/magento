<?php

/**
 *  For use run command in console BASH mode:
 * php bin/magento import:storelocator:csv -p 1location.csv
 *
 */

namespace Slark\StoreLocator\Console\Command;

use Exception;
use Magento\Framework\File\Csv;
use Slark\StoreLocator\Api\Data\StoreLocatorInterfaceFactory;
use Slark\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportFile extends Command
{
    /**
     * @var StoreLocatorInterfaceFactory
     */
    protected StoreLocatorInterfaceFactory $storeLocatorFactory;
    /**
     * @var Csv
     */
    protected Csv $csv;
    /**
     * @var StoreLocatorRepositoryInterface
     */
    protected StoreLocatorRepositoryInterface $storeLocatorRepository;

    /**
     * @param StoreLocatorInterfaceFactory $storeLocatorFactory
     * @param Csv $csv
     * @param StoreLocatorRepositoryInterface $storeLocatorRepository
     */
    public function __construct(
        StoreLocatorInterfaceFactory    $storeLocatorFactory,
        Csv                             $csv,
        StoreLocatorRepositoryInterface $storeLocatorRepository
    ) {
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->csv = $csv;
        $this->storeLocatorRepository = $storeLocatorRepository;
        parent::__construct();
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('import:storelocator:csv');
        $this->setDescription('Import stores from csv to DB');
        $this->addOption('path', "p", InputOption::VALUE_OPTIONAL, "Path for csv file");
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $path = $input->getOption('path');

        if (empty($path)) {
            throw  new \RuntimeException("Invalid argument");
        }

        try {
            $csvData = fopen($path, 'rb');

            $counter = 1;
            $keys = fgetcsv($csvData);
            while ($row = fgetcsv($csvData)) {
                $store = $this->storeLocatorFactory->create();
                $data = array_combine($keys, $row);

                // set value
                $store->setLongi($data['longitude']);
                $store->setLati($data['latitude']);
                $store->setName($data['name']);
                $store->setAddres($data['addres']);
                $store->setDesc($data['description']);
                $store->setImage($data['image']);
                $store->setUrl($data['url_key']);
                $this->storeLocatorRepository->save($store);
                unset($store);

                echo "Store $counter saved \n";
                $counter++;
            }
        } catch (Exception $e) {
            $output->writeln('Invalid CSV');
            $output->writeln($e->getMessage());
        }
    }
}
