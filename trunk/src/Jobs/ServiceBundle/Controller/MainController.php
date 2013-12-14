<?php

namespace Jobs\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    
    protected $userId;
    protected $email;
    public function init($request)
    {
        if (!isset($_COOKIE['userId']) || !isset($_COOKIE['email'])) {
            $token = $request->query->get('accessToken');
            if (empty($token)) {
                throw new \Exception('Unauthorised Access. Valid token is required', 404);
            }
            $cache = $this->get('jobs_service.cache')->load('users');
            $result = $cache->getItem($token, $success);
            if (!$success) {
                throw new \Exception('Unauthorised Access', 404);
            }
            $cache->touchItem($token);
            $this->userId = $result->getUserId();
            $this->email = $result->getEmail();
        } else if (isset($_COOKIE['userId']) && isset($_COOKIE['email'])) {
            $this->userId = $_COOKIE['userId'];
            $this->email = $_COOKIE['email'];
        } else {
            throw new \Exception('Unauthorised Accesscode', 404);
        }
    }
}
?>
