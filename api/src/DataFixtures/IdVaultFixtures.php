<?php

namespace App\DataFixtures;

use App\Entity\Application;
use App\Entity\Configuration;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\MenuItem;
use App\Entity\Organization;
use App\Entity\Slug;
use App\Entity\Style;
use App\Entity\Template;
use Conduction\CommonGroundBundle\Service\CommonGroundService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class IdVaultFixtures extends Fixture implements DependentFixtureInterface
{
    private $params;
    /**
     * @var CommonGroundService
     */
    private $commonGroundService;

    public function __construct(ParameterBagInterface $params, CommonGroundService $commonGroundService)
    {
        $this->params = $params;
        $this->commonGroundService = $commonGroundService;
    }

    public function getDependencies()
    {
        return [
            ConductionFixtures::class,
            ZuiddrechtFixtures::class,
        ];
    }

    public function load(ObjectManager $manager)
    {
        if (
            !$this->params->get('app_build_all_fixtures') &&
            $this->params->get('app_domain') != 'id-vault.com' && strpos($this->params->get('app_domain'), 'id-vault.com') == false &&
            $this->params->get('app_domain') != 'zuiddrecht.nl' && strpos($this->params->get('app_domain'), 'zuiddrecht.nl') == false &&
            $this->params->get('app_domain') != 'zuid-drecht.nl' && strpos($this->params->get('app_domain'), 'zuid-drecht.nl') == false
        ) {
            return false;
        }

        // Dan zuidrecht secifieke dingen
        $id = Uuid::fromString('360e17fb-1a98-48b7-a2a8-212c79a5f51a');
        $organization = new Organization();
        $organization->setName('Id-vault platform');
        $organization->setDescription('Id-vault platform');
        $organization->setRsin('');
        $manager->persist($organization);
        $organization->setId($id);
        $manager->persist($organization);
        $manager->flush();
        $organization = $manager->getRepository('App:Organization')->findOneBy(['id'=> $id]);

        $id = Uuid::fromString('7505125b-efc2-4612-b119-4ce34fb68696');
        $favicon = new Image();
        $favicon->setName('Id-vault Favicon');
        $favicon->setDescription('Id-vault Favicon');
        $favicon->setBase64('data:image/gif;base64,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');
        $favicon->setOrganization($organization);
        $manager->persist($favicon);
        $favicon->setId($id);
        $manager->persist($favicon);
        $manager->flush();
        $favicon = $manager->getRepository('App:Image')->findOneBy(['id'=> $id]);

        $style = new Style();
        $style->setName('Id-vault');
        $style->setDescription('Huistlijl id vault');
        $style->setCss('
        :root {
                --primary: #01689b;
                --primary-color: white;
                --background: #01689b;
                --secondary: #cce0f1;
                --secondary-color: #2b2b2b;

                --menu: #01689b;
                --menu-over: #3669A5;
                --menu-color: white;
                --footer: #01689b;
                --footer-color: white;
         }
        ');
        $style->setfavicon($favicon);
        $style->addOrganization($organization);
        $manager->persist($style);
        $manager->flush();

        $configuration = new Configuration();
        $configuration->setName('id-vault.com configuration');
        $configuration->setDescription('De configuratie van id vault');
        $configuration->setOrganization($organization);
        $configuration->setConfiguration(
            [
                'mainMenu'              => '2295c6d5-8800-4a70-8011-d377b0b69ddf',
                'home'                  => $this->commonGroundService->cleanUrl(['component'=>'wrc', 'type'=>'templates', 'id'=>'e3d39a03-eb43-42ae-a756-136429b8c350']),
                'userPage'              => 'me',
                'login'                 => ['user'=>true, 'facebook'=>true, 'gmail'=>true],
            ]
        );
        $manager->persist($configuration);

        $id = Uuid::fromString('22888b97-d12b-4505-9a20-ee9cc148d442');
        $application = new Application();
        $application->setName('Id-vault');
        $application->setDescription('Id-vault application');
        $application->setDomain('id-vault.com');
        $application->setStyle($style);
        $application->setOrganization($organization);
        $application->setDefaultConfiguration($configuration);
        $manager->persist($application);
        $application->setId($id);
        $manager->persist($application);
        $manager->flush();
        $application = $manager->getRepository('App:Application')->findOneBy(['id'=> $id]);

        // Menu
        $id = Uuid::fromString('2295c6d5-8800-4a70-8011-d377b0b69ddf');
        $menu = new Menu();
        $menu->setName('Id-vault Main Menu');
        $menu->setDescription('Het hoofdmenu van deze website');
        $menu->setApplication($application);
        $manager->persist($menu);
        $menu->setId($id);
        $manager->persist($menu);
        $manager->flush();
        $menu = $manager->getRepository('App:Menu')->findOneBy(['id'=> $id]);

        $menuItem = new MenuItem();
        $menuItem->setOrder(1);
        $menuItem->setIcon('fas fa-home');
        $menuItem->setType('slug');
        $menuItem->setHref('/');
        $menuItem->setMenu($menu);
        $menuItem->setTranslatableLocale('nl'); // change locale
        $menuItem->setName('Home');
        $menuItem->setDescription('Ga terug naar de home page');
        $manager->persist($menuItem);
        $manager->flush();
        $menuItem->setTranslatableLocale('en'); // change locale
        $menuItem->setName('Home');
        $menuItem->setDescription('Go back to the main page');
        $manager->persist($menuItem);

        // Pages
        $id = Uuid::fromString('e3d39a03-eb43-42ae-a756-136429b8c350');
        $template = new Template();
        $template->setTemplateEngine('twig');
        $template->setTranslatableLocale('nl'); // change locale
        $template->setName('Id-vault Home');
        $template->setDescription('Homepage voor id-vault.com');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/IdVault/index.html.twig', 'r'));
        $manager->persist($template);
        $manager->flush();
        $template->setTranslatableLocale('en'); // change locale
        $template->setName('Id-vault Home');
        $template->setDescription('Homepage voor id-vault.com');
        $template->setContent(file_get_contents(dirname(__FILE__).'/Resources/IdVault/index.html.twig', 'r'));
        $manager->persist($template);
        $template->setId($id);
        $manager->persist($template);
        $manager->flush();
        $template = $manager->getRepository('App:Template')->findOneBy(['id'=> $id]);
        $manager->persist($template);

        $slug = new Slug();
        $slug->setTemplate($template);
        $slug->setApplication($application);
        $slug->setName('home');
        $slug->setSlug('home');
        $manager->persist($slug);
        $manager->flush();
    }
}
