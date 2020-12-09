<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Organization;
use App\Entity\Style;
use App\Entity\Template;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LarpingFixtures extends Fixture
{
    private $params;

    /**
     * @var CommonGroundService
     */
    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function load(ObjectManager $manager)
    {
        // Lets make sure we only run these fixtures on larping enviroment
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        $id = Uuid::fromString('7b863976-0fc3-4f49-a4f7-0bf7d2f2f535');
        $organization = new Organization();
        $organization->setName('Larping');
        $organization->setDescription('Larping organization');
        $organization->setRsin('');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'51178e23-62e8-42f1-a96b-f60e7513a694']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Application
        $id = Uuid::fromString('9798cae6-187a-434f-bd66-f1dc2cc61466');
        $application = new Application();
        $application->setName('Larping.eu');
        $application->setDescription('Larping application');
        $application->setDomain('larping.eu');
        $application->setOrganization($organization);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $manager->flush();



        // Image
//        $id = Uuid::fromString('50e8a292-078a-4569-8ca7-f8a21ddcb8b6');
//        $image = new Image();
//        $image->setName('Larping Favicon');
//        $image->setDescription('The favicon for the larping organization');
//        $image->setBase64('AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAD///8A////AP///wD///8A////AP///wD///8A////AP///wDFxcU/CgoK/9LS0j////8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8AHh4e/5CQkH7///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AJCQkH7IyMg/////AAUFBf/a2to/////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wCMjIx+VlZWv5SUlH4GBgb/xcXFP////wD///8A////AP///wD///8A////AP///wD///8A////AICAgH5hYWG/z8/PPwUFBf9QUFC/ExMT/5CQkH7///8A////AP///wD///8A////AP///wD///8A////AP///wBBQUH/GBgY/////wAbGxv/Tk5O/x4eHv////8A////AP///wD///8A////AP///wD///8A////AP///wD///8AMDAw/xEREf////8AhISEfh4eHv8kJCT/////AP///wD///8A////AP///wD///8A////AP///wD///8A////AB8fH/8BAQH/0dHRP6ampn4BAQH/JiYm/////wD///8A////AP///wD///8A////AP///wD///8A////AP///wAODg7/AAAA/5WVlX7///8ACwsL/ycnJ/////8A////AP///wD///8A////AP///wD///8A////AP///wD///8AFBQU/xwcHP+BgYF+////ACMjI/8wMDD/////AP///wD///8A////AP///wD///8A////AP///wD///8A////ACIiIv9kZGS/HBwc/////wCDg4N+Kysr/////wD///8A////AP///wD///8A////AP///wD///8A////AP///wAZGRn/lJSUfk1NTb/T09M/FhYW/4yMjH7///8A////AP///wD///8A////AP///wD///8A////AP///wD///8AEBAQ/4WFhX6ampp+X19fv////wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AAkJCf+Tk5N+////ABoaGv/e3t4/////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wAGBgb/pqamfv///wDFxcU/Y2Njv////wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AP///wD///8A////AKGhoX5paWm/0NDQP////wD///8A////AP///wD///8A/98AAP+/AAD/vwAA/r8AAPo/AADyPwAA8z8AAPM/AADzPwAA8z8AAPG/AAD1fwAA9v8AAPb/AAD3fwAA/78AAA==');
//        $image->setOrganization($larping);
//        $manager->persist($image);
//        $image->setId($id);
//        $manager->persist($image);
//        $manager->flush();
//        $image = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);
//
//        // Style
//        $style = new Style();
//        $style->setName('Larping UI');
//        $style->setDescription('Stijldefinities voor de Larping applicatie');
//        $style->setCss('');
//        $style->setFavicon($image);
//        $style->addOrganization($larping);
//        $manager->persist($style);
//
//        // Menu
//        //$id = Uuid::fromString('505b716c-9461-4588-95d7-8279b3042807');
//        $menu = new Menu();
//        $menu->setName('Larping menu');
//        $menu->setDescription('');
//        $menu->setApplication($application);
//        $manager->persist($menu);
//        //$menu->setId($id);
//        //$manager->persist($menu);
//        //$manager->flush();
//        //$menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);
//
//        // MenuItem
//        $menuItem = new MenuItem();
//        $menuItem->setName('Organisaties');
//        $menuItem->setDescription('Hier staan de organisaties die producten aanbieden op Larping.eu');
//        $menuItem->setHref('app_organization_index');
//        $menuItem->setMenu($menu);
//        $manager->persist($menuItem);
//
//        // MenuItem
//        $menuItem = new MenuItem();
//        $menuItem->setName('Producten');
//        $menuItem->setDescription('Hier staan de aangeboden producten');
//        $menuItem->setHref('app_product_index');
//        $menuItem->setMenu($menu);
//        $manager->persist($menuItem);
//
//        //$id = Uuid::fromString('3b96e9bc-1d9c-4701-9554-4a597f01f4bf');
//        $clientSMS = new Template();
//        $clientSMS->setName('Bestel Bevestiging | Klant | SMS');
//        $clientSMS->setDescription('Deze sms bevestigd een bestelling aan een klant');
//        $clientSMS->setContent('U heeft iets besteld');
//        $clientSMS->setTemplateEngine('twig');
//        $clientSMS->setOrganization($larping);
//        $clientSMS->setApplication($application);
//        $manager->persist($clientSMS);
//
//        $id = Uuid::fromString('cc7d0c70-bb59-4d85-9845-863e896e6ee9');
//        $clientMail = new Template();
//        $clientMail->setName('Bestel Bevestiging | Klant | Email');
//        $clientMail->setTitle(' ');
//        $clientMail->setDescription('Deze email bevestigd een bestelling aan een klant');
////    	$clientMail->setContent('U heeft iets besteld');
//        $clientMail->setContent('Beste {{ contact.givenName }},<br><br>Tof dat je je hebt ingeschreven voor VA! Op de website kun je alle verdere informatie vinden zoals de eventguide, spelregels en ook de algemene settinginformatie. Daarnaast zijn de terms en conditions terug te vinden op https://larping.eu/terms-of-services.<br><br>Heb je nog spelgerelateerde vragen? Mail dan naar: vortexspelleider@gmail.com<br><br>Heb je nog feedback en kan het �cht niet wachten tot de evaluatie? Mail je feedback dan naar vasecretaris@gmail.com , en dan streven we naar een reactie binnen 2 weken!<br><br>We zien je op het evenement!<br><br>Groetjes,<br>Het VA bestuur');
//        $clientMail->setTemplateEngine('twig');
//        $clientMail->setOrganization($larping);
//        $clientMail->setApplication($application);
//        $manager->persist($clientMail);
//        $clientMail->setId($id);
//        $manager->persist($clientMail);
//
//        //$id = Uuid::fromString('db583bf1-22ab-47d5-8656-a6faf95a1f7f');
//        $organizationSMS = new Template();
//        $organizationSMS->setName('Bestel Bevestiging | Organisatie | SMS');
//        $organizationSMS->setDescription('Deze sms bevestigd een bestelling aan een organisatie');
//        $organizationSMS->setContent('Er is iets besteld');
//        $organizationSMS->setTemplateEngine('twig');
//        $organizationSMS->setOrganization($larping);
//        $organizationSMS->setApplication($application);
//        $manager->persist($organizationSMS);
//
//        $id = Uuid::fromString('e287f1f4-704e-49e3-8a33-eab955ff2158');
//        $organizationMail = new Template();
//        $organizationMail->setName('Bestel Bevestiging | Organisatie | EMAIL');
//        $organizationMail->setTitle(' ');
//        $organizationMail->setDescription('Deze email bevestigd een bestelling aan een organisatie');
//        $organizationMail->setContent('Er is iets besteld');
//        $organizationMail->setTemplateEngine('twig');
//        $organizationMail->setOrganization($larping);
//        $organizationMail->setApplication($application);
//        $manager->persist($organizationMail);
//        $organizationMail->setId($id);
//        $manager->persist($organizationMail);
//
//        // Larping / Larping Configuration
//        /*@todo we should take local development into consideration, this only works for online enviroments with a domain*/
//        $env = '';
//        $protocol = 'https://';
//        if ($this->params->get('app_env') != 'prod') {
//            $env = $this->params->get('app_env').'.';
//        }
//
//        $configParams = [];
//
//        $larpingUiParams = [];
//        $larpingUiParams['menuPrimary'] = $protocol.$this->params->get('app_name').'.'.$env.$this->params->get('app_domain')[0].'/menus/'.(string) $menu->getId();
//        $larpingUiParams['menuFooter1'] = $protocol.$this->params->get('app_name').'.'.$env.$this->params->get('app_domain')[0].'/menus/'.(string) $menu->getId();
//        $larpingUiParams['menuFooter2'] = $protocol.$this->params->get('app_name').'.'.$env.$this->params->get('app_domain')[0].'/menus/'.(string) $menu->getId();
//        $larpingUiParams['confirmationClientSMS'] = $protocol.$this->params->get('app_name').'.'.$env.$this->params->get('app_domain')[0].'/templates/'.(string) $clientSMS->getId();
//        $larpingUiParams['confirmationClientMail'] = $protocol.$this->params->get('app_name').'.'.$env.$this->params->get('app_domain')[0].'/templates/'.(string) $clientMail->getId();
//        $larpingUiParams['confirmationOrganizationSMS'] = $protocol.$this->params->get('app_name').'.'.$env.$this->params->get('app_domain')[0].'/templates/'.(string) $organizationSMS->getId();
//        $larpingUiParams['confirmationOrganizationMail'] = $protocol.$this->params->get('app_name').'.'.$env.$this->params->get('app_domain')[0].'/templates/'.(string) $organizationMail->getId();
//
//        $configParams['larpingUi'] = $larpingUiParams;
//
//        $bcParams = [];
//        $bcParams['paymentProviders'] = [];
//
//        $configParams['bc'] = $bcParams;
//
//        $bsParams = [];
//        $bsParams['services'] = [];
//
//        $configParams['bs'] = $bsParams;
//
//        $configuration = new Configuration();
//        $configuration->setApplication($application);
//        $configuration->setOrganization($larping);
//        $configuration->setConfiguration($configParams);
//        $manager->persist($configuration);
//
//        // Vortex Adventures
//        $va = new Organization();
//        $va->setName('Vortex Adventures');
//        $va->setDescription('Va');
//        $va->setRsin('');
//        $manager->persist($va);
//
//        // Fix Id (for linked datapurposes)
//        $id = Uuid::fromString('0972a00f-1893-4e9b-ac13-0e43f225eca5');
//        $va->setId($id);
//        $manager->persist($va);
//        $manager->flush();
//        $va = $manager->getRepository('App:Organization')->findOneBy(['id'=> '0972a00f-1893-4e9b-ac13-0e43f225eca5']);
//
//        // Larping / Vortex Adventures
//
//        $configParams = [];
//
//        $larpingUiParams = [];
//        $configParams['larpingUi'] = $larpingUiParams;
//
//        $bcParams = [];
//        $bcParams['paymentProviders'] = [];
//
//        $configParams['bc'] = $bcParams;
//
//        $configuration = new Configuration();
//        $configuration->setApplication($application);
//        $configuration->setOrganization($va);
//        $configuration->setConfiguration($configParams);
//        $manager->persist($configuration);
//
//        $manager->flush();
    }
}
