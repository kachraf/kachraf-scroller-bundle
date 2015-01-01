<?php

namespace Kachraf\Bundle\ScrollBundle\Controller;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ArticleController
 * @author Achraf KRID achraf.krid@kachraf.com
 * @package Kachraf\Bundle\ScrollBundle\Controller
 */
class ArticleController extends Controller
{
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
            ->from('KachrafScrollBundle:Article',  'b')
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

        $article = $em->getRepository('KachrafScrollBundle:Article')->find($id);
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

}





