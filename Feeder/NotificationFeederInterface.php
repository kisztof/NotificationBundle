<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\Feeder;

use KisztoF\NotificationBundle\Notification\NotificationInterface;

/**
 * Interface NotificationFeederInterface
 */
interface NotificationFeederInterface
{
    /**
     * @param NotificationInterface $notification
     */
    public function feedNotification(NotificationInterface $notification);
}
