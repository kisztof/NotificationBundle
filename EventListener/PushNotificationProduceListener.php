<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\EventListener;

use KisztoF\NotificationBundle\Event\NotificationEventInterface;
use KisztoF\NotificationBundle\Feeder\PushNotificationFeeder;

/**
 * Class PushNotificationProduceListener
 */
class PushNotificationProduceListener implements NotificationProduceListenerInterface
{
    /**
     * @var PushNotificationFeeder
     */
    private $feeder;

    /**
     * NotificationProduceListener constructor.
     *
     * @param PushNotificationFeeder $feeder
     */
    public function __construct(PushNotificationFeeder $feeder)
    {
        $this->feeder = $feeder;
    }

    /**
     * {@inheritdoc}
     */
    public function produceNotifications(NotificationEventInterface $event)
    {
        $this->feeder->feedNotification($event->getNotification());
    }
}
