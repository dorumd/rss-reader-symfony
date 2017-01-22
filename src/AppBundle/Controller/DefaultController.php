<?php

namespace AppBundle\Controller;

use AppBundle\Repository\FeedItemRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $items = FeedItemRepository::findByTitle($this->getFeed('ny_times')->getItems(), $request->query->get('title', ''));

        return $this->render('default/index.html.twig', [
            'feedItems' => $items,
        ]);
    }

    /**
     * Get feed from a specific provider
     *
     * @param $provider
     *
     * @return \AppBundle\Model\FeedInterface
     */
    private function getFeed($provider)
    {
        $feedBuilder = $this->get(sprintf('app.feed_builder.%s', $provider));

        return $this->get('app.director.feed')->build($feedBuilder);
    }
}
