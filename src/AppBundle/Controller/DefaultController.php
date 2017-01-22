<?php

namespace AppBundle\Controller;

use AppBundle\Builder\FeedBuilderInterface;
use AppBundle\Manager\FeedManager;
use AppBundle\Repository\FeedItemRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="app_default_index")
     */
    public function indexAction(Request $request)
    {
        $items = FeedManager::mergeFeeds(
            [$this->getFeed('ny_times'), $this->getFeed('hacker_news')],
            $this->getParameter('feed_items_limit')
        );
        $filteredItems = FeedItemRepository::findByTitle($items, $request->query->get('title', ''));

        return $this->render('default/index.html.twig', [
            'feedItems' => $filteredItems,
        ]);
    }

    /**
     * @Route("/{feed}", name="app_default_feed")
     */
    public function feedAction(Request $request, $feed = '')
    {
        try {
            $items = FeedItemRepository::findByTitle($this->getFeed($feed)->getItems(), $request->query->get('title', ''));

            return $this->render('default/index.html.twig', [
                'feedItems' => $items,
            ]);
        } catch(\Exception $e) {
            throw $this->createNotFoundException(sprintf('Feed named %s is not configured.', $feed));
        }
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
        /** @var FeedBuilderInterface $feedBuilder */
        $feedBuilder = $this->get(sprintf('app.feed_builder.%s', $provider));

        return $this->get('app.director.feed')->build($feedBuilder);
    }
}
