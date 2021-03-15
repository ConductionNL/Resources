<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Category;
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
            $this->params->get('app_domain') != 'larping.eu' && strpos($this->params->get('app_domain'), 'larping.eu') == false
        ) {
            return false;
        }

        $id = Uuid::fromString('d24e147f-00b9-4970-9809-6684a3fb965b');
        $larpingOrg = new Organization();
        $larpingOrg->setName('Larping');
        $larpingOrg->setDescription('Larping organization');
        $larpingOrg->setRsin('');
        $larpingOrg->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'51178e23-62e8-42f1-a96b-f60e7513a694']));
        $manager->persist($larpingOrg);
        $larpingOrg->setId($id);
        $manager->persist($larpingOrg);
        $manager->flush();
        $larpingOrg = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        // Application
        $id = Uuid::fromString('e163dcd7-c35e-4367-9a69-cf553b19c379');
        $application = new Application();
        $application->setName('Larping.eu');
        $application->setDescription('Larping application');
        $application->setDomain('larping.eu');
        $application->setOrganization($larpingOrg);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $manager->flush();

        $id = Uuid::fromString('51eb5628-3b37-497b-a57f-6b039ec776e5');
        $organization = new Organization();
        $organization->setName('Vortex Adventures');
        $organization->setDescription('Vortex Adventures organization');
        $organization->setRsin('');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'c69a9073-9d72-4743-ad33-3c4c7fb34589']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $manager->flush();

        $id = Uuid::fromString('f85e3808-7744-4fd4-a1e1-4b903c5f3d9d');
        $organization = new Organization();
        $organization->setName('Conduction');
        $organization->setDescription('Conduction organization');
        $organization->setRsin('');
        $organization->setContact($this->commonGroundService->cleanUrl(['component'=>'cc', 'type'=>'organizations', 'id'=>'a2177b92-56e0-4edf-9af2-8b98eb2aea0e']));
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $manager->flush();

        // Regions
        $regions = new Category();
        $regions->setName('regions');
        $regions->setOrganization($larpingOrg);
        $regions->setIcon('fab fa-fort-awesome');
        $manager->persist($regions);
        $manager->flush();
        $regions = $manager->getRepository('App:Category')->findOneBy(['id'=> (string) $regions->getId()]);

        $europe = new Category();
        $europe->setName('Europe');
        $europe->setOrganization($larpingOrg);
        $europe->setIcon('fab fa-fort-awesome');
        $europe->setParent($regions);
        $manager->persist($europe);
        $manager->flush();

        $category = new Category();
        $category->setName('Netherlands');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fab fa-fort-awesome');
        $category->setParent($europe);
        $manager->persist($category);
        $manager->flush();

        // Categories
        $settings = new Category();
        $settings->setName('settings');
        $settings->setOrganization($larpingOrg);
        $settings->setIcon('fab fa-fort-awesome');
        $manager->persist($settings);
        $manager->flush();
        $settings = $manager->getRepository('App:Category')->findOneBy(['id'=> (string) $settings->getId()]);

        $id = Uuid::fromString('95dac93a-c56b-4158-b095-df1e13425cd2');
        $category = new Category();
        $category->setName('low fantasy');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-flask-potion');
        $category->setParent($settings);
        $manager->persist($category);
        $category->setId($id);
        $manager->flush();

        $id = Uuid::fromString('2b75bda8-b8fd-428c-80e3-d00370d078df');
        $category = new Category();
        $category->setName('high fantasy');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-magic');
        $category->setParent($settings);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('bd7078ad-8531-4bc2-9c6f-4f7311f21c31');
        $category = new Category();
        $category->setName('general members meeting');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-handshake');
        $category->setParent($settings);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('8dda3a5f-bfbe-4468-81cd-44910fcd4663');
        $category = new Category();
        $category->setName('post apocalypse');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-biohazard');
        $category->setParent($settings);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('d06278df-bb53-4c1b-a038-7b80948e3d64');
        $category = new Category();
        $category->setName('medieval');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-chess-rook');
        $category->setParent($settings);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('c9916d80-0f53-4a4a-992f-e3ee7c1c790f');
        $category = new Category();
        $category->setName('historic');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-user-cowboy');
        $category->setParent($settings);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('d1dbf62a-3e76-42ae-8154-4e8ae42cfe96');
        $category = new Category();
        $category->setName('future');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-user-astronaut');
        $category->setParent($settings);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $features = new Category();
        $features->setName('features');
        $features->setOrganization($larpingOrg);
        $features->setIcon('fal fa-chess-rook');
        $manager->persist($features);
        $manager->flush();

        $id = Uuid::fromString('b70f9bdb-cdb2-45f4-8d8b-ac6e6fbf977e');
        $category = new Category();
        $category->setName('showers');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-bath');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('165fb2eb-8e9b-49d6-8d4e-dd26b0688269');
        $category = new Category();
        $category->setName('camping');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-campground');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('f9c2828d-1374-4cf5-9a07-945792b50ace');
        $category = new Category();
        $category->setName('wifi');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-wifi');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('fed78a82-f878-499a-9686-1188f86ef1f7');
        $category = new Category();
        $category->setName('parking');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-parking');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('a89e94eb-13d3-422a-b51c-ad2ea4265c4e');
        $category = new Category();
        $category->setName('kitchen');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-refrigerator');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('57e7edf3-e762-433b-bd20-9ce3d56a1c83');
        $category = new Category();
        $category->setName('cutlery');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-utensils');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('2a3d1cf8-f959-46d3-b876-5564829811b7');
        $category = new Category();
        $category->setName('stroom');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-outlet');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('6e716455-3d18-4d08-a4e2-4c8294a4dd5e');
        $category = new Category();
        $category->setName('water');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-tint');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('03bdead7-7956-4ea3-bce8-286cffa70cd9');
        $category = new Category();
        $category->setName('bungelows');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-house-day');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('d424fc30-8795-4a73-9890-cf1423dc05c4');
        $category = new Category();
        $category->setName('beds');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fab fa-bed');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('f5b15874-98c7-4fd7-9477-5a300a0f8191');
        $category = new Category();
        $category->setName('dormitory');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-bed-bunk');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('6c84f964-ed0d-4518-89fb-c1f1e50b2cc0');
        $category = new Category();
        $category->setName('wi-fi');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-wifi');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('4d56fd2c-c9c3-4201-aa47-7f6ea51937c0');
        $category = new Category();
        $category->setName('parking');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-parking');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('1a8e3391-d646-4eda-817e-08f90df30800');
        $category = new Category();
        $category->setName('kitchen');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-sink');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('0def49c5-d755-4243-8c6d-a98697bf0872');
        $category = new Category();
        $category->setName('cutlery');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-utensils-alt');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('d1119c2b-4703-4aab-9656-c86899b3c4d1');
        $category = new Category();
        $category->setName('power');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-plug');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('aa37d2c6-4df1-4098-8e6d-63f41a08e435');
        $category = new Category();
        $category->setName('water');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-water');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('2b388eaa-8fcc-4920-b514-f25b5aff93e2');
        $category = new Category();
        $category->setName('bungalows');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fas fa-house-day');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('6fa95bde-5b7d-4613-8220-fe9284689da7');
        $category = new Category();
        $category->setName('indoor');
        $category->setOrganization($larpingOrg);
        $category->setIcon('fal fa-house');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('e82350c9-e60f-4609-9e8b-d87e04f3e63a');
        $category = new Category();
        $category->setName('outdoor');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-cloud-sun');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('e6618d64-a431-4c28-95c4-94360bf94279');
        $category = new Category();
        $category->setName('campfire');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-campfire');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('5359ef36-a74b-4415-9dd4-438e692a6e94');
        $category = new Category();
        $category->setName('pioneer wood');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-tree-alt');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
        $manager->flush();

        $id = Uuid::fromString('1157850b-ab71-4d0e-a1a0-49c13e3687a6');
        $category = new Category();
        $category->setName('nature environment');
        $category->setOrganization($larpingOrg);
        $category->setIcon('far fa-leaf');
        $category->setParent($features);
        $manager->persist($category);
        $category->setId($id);
        $manager->persist($category);
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
