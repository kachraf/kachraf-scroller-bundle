Kachraf\\Bundle\\ScrollBundle
================================

This bundle adds a paginating scroll

Installation
------------


### Parameters

Example setup in our built-in demo:

    # app/config/config.yml

    kachraf_scroll:
        scrollers:
            scroller1:
                name: scroller1
                page_range: 5
                template:
                    main_page: KachrafTestBundle:Default:index.html.twig
                    page: KachrafTestBundle:Default:show.html.twig
            scroller2:
                name: scroller2
                page_range: 8
                template:
                    main_page: KachrafScrollBundle:Article:index.html.twig
                    page: KachrafScrollBundle:Article:show.html.twig


Where:

-   `page_range`: number of "Article" to load on each scroll.
-   `template.main_page`: The main layout of the page. For this version you must use
    the given main page /Kachraf/Bundle/ScrollBundle/Resources/views/Article/index.html.twig
    copy its content to your main_page bundle, and modify it.
-   `template.page`: The layout of one "Article" same thing to main_page.

### Registering

You have to add `KachrafScrollBundle` to your `AppKernel.php`:

    # app/AppKernel.php

    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                new Kachraf\Bundle\TestBundle\KachrafTestBundle(),

            );

            return $bundles;
        }
    }

Usage
-----
"Article" is the name of the Object that we will load dynamically when scrolling
We used to have two index:
"my_test_homepage" for the first time page load (GET call),
and another one, which i called "my_test_ajax_call" (POST call) to load
dynamically "Articles"

    # MyBundle/Resources/config/routing.yml

        my_test_homepage:
            pattern:  /
            defaults: { _controller: MyBundle:Default:index }
            methods:  [GET]
        my_test_ajax_call:
            pattern:  /
            defaults: { _controller: MyBundle:Default:index2 }
            requirements:
                _method:  POST

Here is an example of controller.

# MyBundle/Controller/DefaultController.php
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

...


public function indexAction()
{
    $scroll = $this->get("kachraf_scroll_scroller");
    $articles= $this->paginate(1);
    $html_article ="";
    foreach($articles as $article)
        $html_article .= $this->getRenderedArticle($article);

    $template = $scroll->getTemplate();
    return $this->render($template->getMainPage(), array(
        'html_article' => $html_article
    ));
}

public function index2Action(Request $request)
{
    $current_page =  $request->request->get('current_page');
    $articles= $this->paginate($current_page);

    $html_article ="";
    foreach($articles as $article)
        $html_article .= $this->getRenderedArticle($article);

    return  new Response($html_article);
}

public function paginate( $currentPage)
{
    $pageSize = $this->get("kachraf_scroll_scroller")->getPageRange();
    $em = $this->getDoctrine()->getManager();

    $dql = $em->createQueryBuilder()
        ->select('b')
        ->from('MyBundle:Article',  'b')
        ->addOrderBy('b.created', 'DESC');

    $paginator = new Paginator($dql);

    $paginator
        ->getQuery()
        ->setFirstResult($pageSize * ($currentPage - 1)) // set the offset
        ->setMaxResults($pageSize); // set the limit

    return $paginator;
}

/**
 * @Template()
 */
public function showAction($id)
{
    $em = $this->getDoctrine()->getEntityManager();

    $article = $em->getRepository('MyBundle:Article')->find($id);
    if (!$article) {
        throw $this->createNotFoundException('Unable to find Article post.');
    }

    $template = $this->get("kachraf_scroll_scroller")->getTemplate();
    return $this->render($template["page"], array(
        'article'      => $article,
    ));
}

public function getRenderedArticle ($article)
{
    $template = $this->get("kachraf_scroll_scroller")->getTemplate();
    return $this->renderView($template->getPage(), array(
        'article' => $article
    ));
}

