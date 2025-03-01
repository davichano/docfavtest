<?php

use Domain\User\Event\UserRegisteredEvent;
use Infrastructure\EventListener\UserRegisteredListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/logger.php';

/**
 * @return EventDispatcher
 */
function getEventDispatcher(): EventDispatcher
{
    static $eventDispatcher = null;
    if ($eventDispatcher) {
        return $eventDispatcher;
    }

    $eventDispatcher = new EventDispatcher();

    $logger = getLogger();
    $userRegisteredListener = new UserRegisteredListener($logger);
    $eventDispatcher->addListener(UserRegisteredEvent::class, [$userRegisteredListener, 'onUserRegistered']);

    return $eventDispatcher;
}
