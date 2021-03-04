<?php

namespace Ernestblaz\CreateAdmin\Console;

use Ernestblaz\Database\Model\VendorFactory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddVendor extends \Symfony\Component\Console\Command\Command
{
    const VENDOR_NAME = 'vendor_name';
    const VENDOR_CODE = 'vendor_code';
    const VENDOR_TYPE = 'vendor_type';

    /**
     * @var VendorFactory
     */
    private $vendorFactory;

    public function __construct(VendorFactory $vendorFactory)
    {
        $this->vendorFactory = $vendorFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $options = [
            new InputOption(
                self::VENDOR_NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Vendor name'
            ),
            new InputOption(
                self::VENDOR_CODE,
                null,
                InputOption::VALUE_REQUIRED,
                'Vendor code'
            ),
            new InputOption(
                self::VENDOR_TYPE,
                null,
                InputOption::VALUE_REQUIRED,
                'Vendor type'
            )
        ];

        $this->setName('vendor:add')
            ->setDescription('Add vendor command line')
            ->setDefinition($options);

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $vendor = $this->vendorFactory->create();
        $vendor->setVendorName($input->getOption(self::VENDOR_NAME))
            ->setVendorCode($input->getOption(self::VENDOR_CODE))
            ->setVendorType($input->getOption(self::VENDOR_TYPE));

        try {
            $vendor->save();
            $output->writeln("Success");
        } catch (\Exception $ex) {
            $output->writeln($ex->getMessage());
        }
    }
}
