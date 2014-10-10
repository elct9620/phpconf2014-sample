<?php
/**
 * Class HomeController
 * @author Aotoki
 */

use Aotoki\Sample\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return $this->view->render('home/index.html.twig');
    }
}

