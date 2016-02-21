# CmsBundle


## Installation

    public function registerBundles()
    {
        $bundles = array(

            new WH\CmsBundle\WHCmsBundle(),

        );

        ...

## Articles


## Templates

### Des templates de page :
- type : "page",
- tplt : "APPCmsBundle:Page:montemplatedepage"
- controller : "WHCmsBundle:ControllerFront" A préçiser si la page doit faire appel à des fonctiones spéciales
- controllerAdmin : A préçiser si la page contient un formulaire spécifique (l'action updatePage est automatiquement appelée)

Exemple : La page contact doit être insérée dans un menu (arbo), il herite donc de page, c'est un template page

### Des templates d'article :
Idem que précédement, mais lui n'est pas dans l'arborescence du enu, il doit heriter de article
Mais ici updatePost est automatiquement appelé

Exemple : partenaires, temoignaes, références, ...

### Des templates de galeries :
- type : "bloc",
- tplt : "APPCmsBundle:Galerie:bootsrap"

### Des templates de bloc :
Pour insérer des blocs de contenu dans une page
- type : "bloc",
- tplt : "APPCmsBundle:Bloc:montemplatedeblocs" (contient la boucle)
- controller : "WHCmsBundle:ControllerFront" L'action "bloc" est automatiquement appelé
- controllerAdmin : "WHCmsBundle:Backend:Controller" L'action "bloc" est automatiquement appelé pour générer le formulaire bloc adaptée


## Les blocs

Créer un template de type de bloc, préçiser le adminController le controller + action qui permet de controller les infos du front
Dans les blocs on préçise les conditions et la vue



## Les pages


### Blocs dans les pages

blocEntity : type (text, bloc, galerie) title, subtitle, template, body, entity, bloc, position

Et un blocEntityFile pour les galeries

