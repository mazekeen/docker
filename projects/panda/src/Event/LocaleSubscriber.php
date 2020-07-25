<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;


class LocaleSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
    */
    private $defaultLocale;

    public function __construct(string $defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                [
                    'onKernelRequest',
                    20
                ]
            ]
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if (!$request->hasPreviousSession()) {
            return;
        }

        $session = $request->getSession();
        $locale = $request->attributes->get('_locale');

        if ($locale) {
            $session->set('_locale', $locale);

            return;
        }

        $request->setLocale(
            $session->get('_locale', $this->defaultLocale)
        );
    }
}
