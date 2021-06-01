<?php

namespace App\Subscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Application;
use App\Entity\Slug;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class ApplicationSubscriber implements EventSubscriberInterface
{
    private $params;
    private $em;
    private $serializer;

    public function __construct(ParameterBagInterface $params, EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->params = $params;
        $this->em = $em;
        $this->serializer = $serializer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['IngeschrevenpersoonOnBsn', EventPriorities::PRE_VALIDATE],
        ];
    }

    public function IngeschrevenpersoonOnBsn(ViewEvent $event)
    {
        $id = $event->getRequest()->attributes->get('id');
        $slug = $event->getRequest()->attributes->get('slug');

        if (Request::METHOD_GET !== $event->getRequest()->getMethod() || $event->getRequest()->get('_route') != 'api_applications_get_page_on_slug_collection') {
            return;
        }

        $locale = $this->getLocale($event);

        $application = $this->em->getRepository(Application::class)->findOneBy(['id' => $id]);
        $slug = $this->em->getRepository(Slug::class)->findOneBy(['application' => $application, 'slug'=>$slug]);
        if ($slug == null) {
            throw new NotFoundHttpException('Page not found');
        }

        $event->setResponse($this->setResponse($slug->getTemplate()));
    }

    public function getLocale($event)
    {
        if ($locale = $event->getRequest()->query->get('_locale')) {
        } elseif ($locale = $event->getRequest()->request->get('_locale')) {
        } else {
            $locale = 'en';
        }

        return $locale;
    }

    public function setResponse($result)
    {
        $json = $this->serializer->serialize(
            $result,
            'json',
            ['enable_max_depth' => true]
        );

        return new Response(
            $json,
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}
