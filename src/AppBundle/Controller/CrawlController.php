<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Goutte\Client;

class CrawlController extends Controller
{
    const CHIIBUS_URL = 'http://www.buskuru.com/chiibus/pc/route.php';

    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $client = new Client();
        $crawler = $client->request('GET', self::CHIIBUS_URL);
        $anchors = $crawler->filter('span.font_wb > a')->each(function($anchor) {
            return $anchor->text();
        });
        $text = implode("<br>", $anchors);
        // return new JsonResponse(
        //     $anchors
        // );
        return new Response(
            $text
        );
    }
}
