<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\Event;

use KisztoF\NotificationBundle\Notification\NotificationInterface;

/**
 * Interface NotificationEventInterface
 */
interface NotificationEventInterface
{
    /**
     * @return NotificationInterface
     */
    public function getNotification(): NotificationInterface;
}
