<?php

namespace AppBundle;

use AppBundle\DependencyInjection\FeedsExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AppBundle
 * @package AppBundle
 * @author  Mardari Dorel <mardari.dorua@gmail.com>
 */
class AppBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new FeedsExtension();
    }
}
