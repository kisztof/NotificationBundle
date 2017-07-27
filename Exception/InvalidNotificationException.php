<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\Exception;

use KisztoF\NotificationBundle\Notification\NotificationInterface;

/**
 * Class InvalidNotificationException
 */
class InvalidNotificationException extends \InvalidArgumentException
{
    /**
     * @var NotificationInterface
     */
    private $notification;

    /**
     * InvalidNotificationException constructor.
     *
     * @param string                $message
     * @param NotificationInterface $notification
     */
    public function __construct($message = "", NotificationInterface $notification)
    {
        parent::__construct($message);

        $this->notification = $notification;
    }

    /**
     * @return NotificationInterface
     */
    public function getNotification(): NotificationInterface
    {
        return $this->notification;
    }
}
