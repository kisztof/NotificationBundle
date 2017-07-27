<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\Notification;

use KisztoF\NotificationBundle\Exception\InvalidNotificationException;

/**
 * Interface NotificationInterface
 */
interface NotificationInterface
{
    /**
     * @return array
     */
    public function exportData(): array;

    /**
     * @return bool
     * @throws InvalidNotificationException
     */
    public function isValid(): bool;
}
