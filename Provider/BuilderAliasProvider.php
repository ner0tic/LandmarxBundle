<?php

namespace Landmarx\Bundle\LandmarxBundle\Provider;

use Landmarx\Landmark\FactoryInterface;
use Landmarx\Landmark\ItemInterface;
use Landmarx\Landmark\Provider\LandmarkProviderInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * A landmark provider that allows for an AcmeBundle:Builder:mainLandmark shortcut syntax
 *
 * @author Ryan Weaver <ryan@knplabs.com>
 */
class BuilderAliasProvider implements LandmarkProviderInterface
{
    private $kernel;

    private $container;

    private $landmarkFactory;

    private $builders = array();

    public function __construct(KernelInterface $kernel, ContainerInterface $container, FactoryInterface $landmarkFactory)
    {
        $this->kernel = $kernel;
        $this->container = $container;
        $this->landmarkFactory = $landmarkFactory;
    }

    /**
     * Looks for a landmark with the bundle:class:method format
     *
     * For example, AcmeBundle:Builder:mainLandmark would create and instantiate
     * an Acme\DemoBundle\Landmark\Builder class and call the mainLandmark() method
     * on it. The method is passed the landmark factory.
     *
     * @param string $name The alias name of the landmark
     * @param array $options
     * @return \Landmarx\Landmark\ItemInterface
     * @throws \InvalidArgumentException
     */
    public function get($name, array $options = array())
    {
        if (!$this->has($name)) {
            throw new \InvalidArgumentException(sprintf('Invalid pattern passed to AliasProvider - expected "bundle:class:method", got "%s".', $name));
        }

        list($bundleName, $className, $methodName) = explode(':', $name);

        $builder = $this->getBuilder($bundleName, $className);
        if (!method_exists($builder, $methodName)) {
            throw new \InvalidArgumentException(sprintf('Method "%s" was not found on class "%s" when rendering the "%s" landmark.', $methodName, $className, $name));
        }

        $landmark = $builder->$methodName($this->landmarkFactory, $options);
        if (!$landmark instanceof ItemInterface) {
            throw new \InvalidArgumentException(sprintf('Method "%s" did not return an ItemInterface landmark object for landmark "%s"', $methodName, $name));
        }

        return $landmark;
    }

    /**
     * Verifies if the given name follows the bundle:class:method alias syntax.
     *
     * @param string $name The alias name of the landmark
     * @param array $options
     * @return Boolean
     */
    public function has($name, array $options = array())
    {
        return 2 == substr_count($name, ':');
    }

    /**
     * Creates and returns the builder that lives in the given bundle
     *
     * The convention is to look in the Landmark namespace of the bundle for
     * this class, to instantiate it with no arguments, and to inject the
     * container if the class is ContainerAware.
     *
     * @param string $bundleName
     * @param string $className The class name of the builder
     * @throws \InvalidArgumentException If the class does not exist
     */
    protected function getBuilder($bundleName, $className)
    {
        $name = sprintf('%s:%s', $bundleName, $className);

        if (!isset($this->builders[$name])) {
            $class = null;
            $logs = array();
            $bundles = array();

            foreach ($this->kernel->getBundle($bundleName, false) as  $bundle) {
                $try = $bundle->getNamespace().'\\Landmark\\'.$className;
                if (class_exists($try)) {
                    $class = $try;
                    break;
                }

                $logs[] = sprintf('Class "%s" does not exist for landmark builder "%s".', $try, $name);
                $bundles[] = $bundle->getName();
            }

            if (null === $class) {
                if (1 === count($logs)) {
                    throw new \InvalidArgumentException($logs[0]);
                }

                throw new \InvalidArgumentException(sprintf('Unable to find landmark builder "%s" in bundles %s.', $name, implode(', ', $bundles)));
            }

            $builder = new $class();
            if ($builder instanceof ContainerAwareInterface) {
                $builder->setContainer($this->container);
            }

            $this->builders[$name] = $builder;
        }

        return $this->builders[$name];
    }
}
