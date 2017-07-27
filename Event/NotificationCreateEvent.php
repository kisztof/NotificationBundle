<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\Event;

use KisztoF\NotificationBundle\Notification\NotificationInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class NotificationCreateEvent
 */
class NotificationCreateEvent extends Event implements NotificationEventInterface
{
    /**
     * @var NotificationInterface
     */
    private $notification;

    /**
     * NotificationCreateEvent constructor.
     *
     * @param NotificationInterface $notification
     */
    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    /**
     * {@inheritdoc}
     */
    public function getNotification(): NotificationInterface
    {
        return $this->notification;
    }
}
