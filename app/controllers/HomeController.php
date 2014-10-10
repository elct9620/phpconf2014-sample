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

    public function create()
    {
        # NOTE: POST data should filter before insert database
        $nickname = $_POST['nickname'];
        $userComment = $_POST['comment'];

        $comment = Comments::create();
        $comment->nickname = $nickname;
        $comment->comment = $userComment;
        $comment->set_expr('created_at', 'NOW()');
        $comment->save();

        # NOTE: Redirect should implement in BaseController
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

