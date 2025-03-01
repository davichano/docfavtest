<?php

namespace Infrastructure\EventListener;

use Psr\Log\LoggerInterface;

class UserRegisteredListener
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onUserRegistered($event): void
    {
        $user = $event->getUser();
        $this->logger->info('User registered: ' . $user->getEmail()->value());
    }
}