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
        $comments = Comments::order_by_desc('created_at')->find_many();
        return $this->view->render('home/index.html.twig', array(
            'comments' => $comments
        ));
    }
}

