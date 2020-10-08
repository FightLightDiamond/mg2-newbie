# Logger

## Zend log
```
$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info('Your text message');
```


## Laminas
```
$writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/test.log');
$logger = new \Laminas\Log\Logger();
$logger->addWriter($writer);
$logger->info('Your text message');
```

## Prs
```
protected $logger;
public function __construct(\Psr\Log\LoggerInterface $logger)
{
    $this->logger = $logger;
}
```

You use debug, exception, system for PSR Logger for example:
```
$this->logger->info($message);
$this->logger->debug($message);
```

## Object manager(Not DI)
```
\Magento\Framework\App\ObjectManager::getInstance()
    ->get(\Psr\Log\LoggerInterface::class)->debug('message');
```

```
$logger = \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class);
$logger->info('message');
```
