<?php

/**
 * This file is part of the "NFQ Bundles" package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nfq\FileManagerBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ServiceCreationTest
 * @package Nfq\FileManagerBundle\Tests\Functional
 */
class ServiceCreationTest extends WebTestCase
{
    /**
     * Tests if container is returned
     */
    public function testGetContainer()
    {
        $container = self::createClient()->getKernel()->getContainer();
        $this->assertNotNull($container);
    }

    /**
     * Tests if service are created correctly.
     *
     * @param string $service
     * @param string $instance
     *
     * @dataProvider getTestServiceCreateData()
     */
    public function testServiceCreate($service = null, $instance = null)
    {
        if(!is_null($service) && !is_null($instance)) {
            $container = self::createClient()->getKernel()->getContainer();
            $this->assertTrue($container->has($service));
            $service = $container->get($service);
            $this->assertInstanceOf($instance, $service);
        }
    }
    /**
     * Data provider for testServiceCreate().
     *
     * @return array[]
     */
    public function getTestServiceCreateData()
    {
        return [
            // Add services to test here ['service.name', 'Service\\Class']
            [],
        ];
    }
}
