<?php

namespace Casio\ImportShipment\Controller\Index;

use Magento\Contact\Model\ConfigInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NotFoundException;

/**
 * Class Order
 * @package Magenest\Salesforce\Controller\Adminhtml\Queue
 */
class Order extends \Magento\Framework\App\Action\Action
{
    const TOPIC_NAME = 'casio_test_queue';
    private $_publisher;

    public function __construct(
        \Magento\Framework\MessageQueue\PublisherInterface $publisher,
        Context $context
    ) {
        parent::__construct($context);
        $this->_publisher = $publisher;
    }

    public function execute()
    {
        $this->_publisher->publish(self::TOPIC_NAME,  date('Y-m-d H:i:s'));

        echo "4324242";
    }
}
