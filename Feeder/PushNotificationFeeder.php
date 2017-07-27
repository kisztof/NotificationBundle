<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\Feeder;

use KisztoF\NotificationBundle\Exception\FeederPublishingException;
use KisztoF\NotificationBundle\Exception\InvalidNotificationException;
use KisztoF\NotificationBundle\Notification\NotificationInterface;
use KisztoF\NotificationBundle\Producer\PushNotificationProducer;
use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * Class PushNotificationFeeder
 */
class PushNotificationFeeder implements LoggerAwareInterface, NotificationFeederInterface
{
    use LoggerAwareTrait;

    /**
     * @var PushNotificationProducer
     */
    private $producer;

    /**
     * PushNotificationFeeder constructor.
     *
     * @param ProducerInterface $producer
     */
    public function __construct(PushNotificationProducer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * {@inheritdoc}
     */
    public function feedNotification(NotificationInterface $message)
    {
        try {
            if ($message->isValid()) {
                $this->producer->publish(json_encode($message->exportData()));
            }
        } catch (InvalidNotificationException $exception) {
            $this->logger->critical($exception);

            throw new FeederPublishingException('Notification is invalid', 0, $exception);
        }
    }
}
