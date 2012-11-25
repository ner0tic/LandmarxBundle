<?php
namespace Landmarx\Bundle\LandmarxBundle\DependencyInjection\Compiler;

use Landmarx\Landmark\Exception\MissingArgumentException as MissingArgument;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class MenuPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('landmarx_landmark.landmark_provider.container_aware')) {
            return;
        }
        $definition = $container->getDefinition('landmarx_landmark.landmark_provider.container_aware');

        $landmarks = array();
        foreach ($container->findTaggedServiceIds('landmarx_landmark.landmark') as $id => $tags) {
            foreach ($tags as $attributes) {
                if (empty($attributes['alias'])) {
                    throw new MissingArgument(sprintf('The alias is not defined in the "landmarx_landmark.landmark" tag for the service "%s"', $id));
                }
                $landmarks[$attributes['alias']] = $id;
            }
        }
        $definition->replaceArgument(1, $landmarks);
    }
}
