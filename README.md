# CmsBundle


## Todo :


Creer bloc page
Crrer les blocs en fixtures

Ajouter le template bloc galerie (lié à file)

Sur bloc :
Editer dans la page pour prévusaliser les résultats, et gérer les galeries


Seo :
Ajout de inherit
Ajout de meta_title_inherit (ajoute en auto l'inherit, ou name si non présent
Inherit par default

Listerner sur seo pour associer auto entity et id
Faire une fonction getUrl qui permet de générer l'url à partir du route name

Créer un Seo par default (sur liste Seo, créer par default)

Ajout de seoMetas permetant d'ajouter toutes les metas nécessaires

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

