<?php
/**
 * @author Krzysztof Słomka <krzysztof.slomka@mint.net.pl>
 */
declare(strict_types=1);

namespace KisztoF\NotificationBundle\Notification;

use KisztoF\NotificationBundle\Exception\InvalidNotificationException;

/**
 * Class PushMessageNotification
 */
class PushMessageNotification implements NotificationInterface, \JsonSerializable
{
    /**
     * @var bool
     */
    private $global = false;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $renderedBody;

    /**
     * @var array
     */
    private $channelHashes;
    
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @return bool
     */
    public function isGlobal(): bool
    {
        return $this->global;
    }

    /**
     * @param bool $global
     *
     * @return PushMessageNotification
     */
    public function setGlobal(bool $global): PushMessageNotification
    {
        $this->global = $global;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return PushMessageNotification
     */
    public function setType(string $type): PushMessageNotification
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return PushMessageNotification
     */
    public function setTitle(string $title): PushMessageNotification
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return PushMessageNotification
     */
    public function setBody(string $body): PushMessageNotification
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getRenderedBody(): string
    {
        return $this->renderedBody;
    }

    /**
     * @param string $renderedBody
     *
     * @return PushMessageNotification
     */
    public function setRenderedBody(string $renderedBody): PushMessageNotification
    {
        $this->renderedBody = $renderedBody;

        return $this;
    }

    /**
     * @return array
     */
    public function getChannelHashes(): array
    {
        return $this->channelHashes;
    }

    /**
     * @param array $channelHashes
     *
     * @return PushMessageNotification
     */
    public function setChannelHashes(array $channelHashes): PushMessageNotification
    {
        $this->channelHashes = $channelHashes;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return PushMessageNotification
     */
    public function setCreatedAt(\DateTime $createdAt): PushMessageNotification
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function exportData(): array
    {
        return [
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'renderedContent' => $this->getRenderedBody(),  
            'attributes' => [
                'channels' => $this->getChannelHashes(),
                'global' => $this->isGlobal(),
                'createdAt' => $this->getCreatedAt(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isValid(): bool
    {
        if (!$this->isGlobal() && empty($this->getChannelHashes())) {
            throw new InvalidNotificationException('Recipients not assigned or message is not global', $this);
        }

        if (empty($this->getRenderedBody()) && empty($this->getBody())) {
            throw new InvalidNotificationException('Notification is empty', $this);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->exportData();
    }
}
