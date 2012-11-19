<?php

namespace Landmarx\Bundle\LandmarxBundle\Provider;

use Landmarx\Landmark\Provider\MenuProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerAwareProvider implements MenuProviderInterface
{
    private $container;
    private $landmarkIds;

    public function __construct(ContainerInterface $container, array $landmarkIds = array())
    {
        $this->container = $container;
        $this->landmarkIds = $landmarkIds;
    }

    public function get($name, array $options = array())
    {
        if (!isset($this->landmarkIds[$name])) {
            throw new \InvalidArgumentException(sprintf('The landmark "%s" is not defined.', $name));
        }

        return $this->container->get($this->landmarkIds[$name]);
    }

    public function has($name, array $options = array())
    {
        return isset($this->landmarkIds[$name]);
    }
}
