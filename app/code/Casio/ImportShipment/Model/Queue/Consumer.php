<?php

namespace Casio\ImportShipment\Model\Queue;

class Consumer
{
    protected $_logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function process(string $dataQueue)
    {
        try {
            //function execute handles saving order object to table
            $this->_logger->debug('Time: ' . date('Y-m-d H:i:s'));
            $this->_logger->debug('Y-m-d H:i:s');
        } catch (\Exception $e) {
            //logic to catch and log errors
            $this->_logger->critical($e->getMessage());
        }
    }
}
