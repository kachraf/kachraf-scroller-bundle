<?php
/**
 * Created by PhpStorm.
 * User: achraf.krid
 * Date: 24/10/14
 * Time: 09:38
 */

namespace Kachraf\Bundle\ScrollBundle\Manager;


/**
 * Class Scroll
 * @author Achraf KRID achraf.krid@kachraf.com
 * @package Kachraf\Bundle\ScrollBundle\Manager
 */
class Scroll {

    protected $name;
    protected $page_range;
    protected $template;

    public function __construct($name, $page_range, $template)
    {
        $this->name = $name;
        $this->page_range = $page_range;
        $this->template = new Template($template['main_page'],$template['page']);

    }



    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $page_range
     */
    public function setPageRange($page_range)
    {
        $this->page_range = $page_range;
    }

    /**
     * @return mixed
     */
    public function getPageRange()
    {
        return $this->page_range;
    }

    /**
     * @param \Kachraf\Bundle\ScrollBundle\Manager\Template $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return \Kachraf\Bundle\ScrollBundle\Manager\Template
     */
    public function getTemplate()
    {
        return $this->template;
    }


} 