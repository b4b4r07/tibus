<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Goutte\Client;

class ChiibusController extends Controller
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
            return [
                'name' => $anchor->text(),
                'link' => $anchor->attr('href'),
            ];
        });
        // $text = "";
        // foreach($anchors as $anchor) {
        //     $text .= sprintf("<a href=\"%s\">%s</a><br>\n", $anchor['link'], $anchor['name']);
        // }
        // return new JsonResponse(
        //     $anchors
        // );
        // var_dump($text);
        // return new Response(
        //     $text
        // );
        return $this->render(
            'chiibus/index.html.twig',
            ['anchors' => $anchors]
        );
    }
}
