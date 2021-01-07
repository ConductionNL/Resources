Additional Information
----

For deployment to kubernetes clusters we use Helm 3.

For an in depth installation guide you can refer to the [installation guide](INSTALLATION.md).

- [Contributing](CONTRIBUTING.md)

- [ChangeLogs](CHANGELOG.md)

- [RoadMap](ROADMAP.md)

- [Security](SECURITY.md)

- [Licence](LICENSE.md)

Description
----
Het WRC bevat de resources die nodig zijn voor het draaien van een applicatie zoals sjablonen, routing, menu’s en afbeeldingen. Het heeft hierbij de doelstelling om te fungeren als een “headless CMS” ofwel een CMS als API die losstaat van enige vorm van weergave. Voor het bewerken van de CMS content leunt het WRC dan ook op de Dashboard (een implementatie van de Proto Applicatie), en het fungeert zelf als een bron voor een Applicatie.

Door het gescheiden houden van opslag en bewerking, is het mogelijk om vanuit één dashboard de inhoud van meerdere applicaties te beheren. Dat levert meer overzicht op, zo zou een sjabloon ook kunnen worden gebruikt in verschillende applicaties en websites. Dit is bijvoorbeeld handig bij algemene informatie of FAQ’s. 

Een extra handigheid van het WRC is dat het meertaligheid op resources ondersteunt en dat maakt het mogelijk om content in meerdere talen aan te maken en te beheren. Het maakt tevens inzichtelijk welke content al wel en welke content nog niet vertaald is en wordt er compliancy aan de WCAG norm voor tweetaligheid opgevolgd.

Met betrekking tot vormgeving biedt het WRC twee belangrijke functionaliteiten aan applicaties, om te beginnen kunnen templates worden “verlengd en uitgebreid”. Dat betekent bijvoorbeeld dat een applicatie gebruik zou kunnen maken van NL Design, maar hier via het WRC een eigen smaak aan toe kan voegen. Doordat het WRC kan delen tussen applicaties, is het hiermee voor een organisatie tevens mogelijk om één consistente huisstijl te voeren voor meerdere applicaties. Daarnaast biedt het WRC een mogelijkheid tot CDN, ofwel het verplaatsen van statische content van een applicatie naar een externe bron. Hiermee wordt het dataverkeer op een applicatie zelf lager en daarmee sneller. Het betekent ook dat op applicatie niveau, logica en statische content uit elkaar kunnen worden getrokken en fysiek op andere (gespecialiseerde) machines kunnen worden geplaatst. 

Tutorial
----

For information on how to work with the component you can refer to the tutorial [here](TUTORIAL.md).

#### Setup your local environment
Before we can spin up our component we must first get a local copy from our repository, we can either do this through the command line or use a Git client. 

For this example we're going to use [GitKraken](https://www.gitkraken.com/) but you can use any tool you like, feel free to skip this part if you are already familiar with setting up a local clone of your repository.

Open gitkraken press "clone a repo" and fill in the form (select where on your local machine you want the repository to be stored, and fill in the link of your repository on github), press "clone a repo" and you should then see GitKraken downloading your code. After it's done press "open now" (in the box on top) and voilá your codebase (you should see an initial commit on a master branch).

You can now navigate to the folder where you just installed your code, it should contain some folders and files and generally look like this. We will get into the files later, lets first spin up our component!

Next make sure you have [docker desktop](https://www.docker.com/products/docker-desktop) running on your computer.

Open a command window (example) and browse to the folder where you just stuffed your code, navigating in a command window is done by cd, so for our example we could type 
cd c:\repos\common-ground\my-component (if you installed your code on a different disk then where the cmd window opens first type <diskname>: for example D: and hit enter to go to that disk, D in this case). We are now in our folder, so let's go! Type docker-compose up and hit enter. From now on whenever we describe a command line command we will document it as follows (the $ isn't actually typed but represents your folder structure):

```CLI
$ docker-compose up
```

Your computer should now start up your local development environment. Don't worry about al the code coming by, let's just wait until it finishes. You're free to watch along and see what exactly docker is doing, you will know when it's finished when it tells you that it is ready to handle connections. 

Open your browser type [<http://localhost/>](https://localhost) as address and hit enter, you should now see your common ground component up and running.


Credits
----

Information about the authors of this component can be found [here](AUTHORS.md)

This component uses the following [schema.org](https://schema.org) sources:
- [Organization](https://schema.org/Organization)
- [Menu](https://schema.org/Menu)
- [MenuItem](https://schema.org/MenuItem)



Copyright © [Utrecht](https://www.utrecht.nl/) 2019
