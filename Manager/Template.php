<?php
/**
 * Created by PhpStorm.
 * User: achraf.krid
 * Date: 12/11/14
 * Time: 09:03
 */

namespace Kachraf\Bundle\ScrollBundle\Manager;


/**
 * Class Template
 * @author Achraf KRID achraf.krid@kachraf.com
 * @package Kachraf\Bundle\ScrollBundle\Manager
 */
class Template {

    protected $main_page;
    protected $page;

    function __construct($main_page, $page)
    {
        $this->main_page= $main_page;
        $this->page= $page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $main_page
     */
    public function setMainPage($main_page)
    {
        $this->main_page = $main_page;
    }

    /**
     * @return mixed
     */
    public function getMainPage()
    {
        return $this->main_page;
    }


}