<?php
namespace Landmarx\Bundle\LandmarxBundle\DependencyInjection\Compiler;

use Landmarx\Landmark\Exception\MissingArgumentException as MissinArgument;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * This compiler pass registers the renderers in the RendererProvider.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class AddRenderersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('landmarx_landmark.renderer_provider')) {
            return;
        }
        $definition = $container->getDefinition('landmarx_landmark.renderer_provider');

        $renderers = array();
        foreach ($container->findTaggedServiceIds('landmarx_landmark.renderer') as $id => $tags) {
            foreach ($tags as $attributes) {
                if (empty($attributes['alias'])) {
                    throw new MissingArgument(sprintf('The alias is not defined in the "landmarx_landmark.renderer" tag for the service "%s"', $id));
                }
                $renderers[$attributes['alias']] = $id;
            }
        }
        $definition->replaceArgument(2, $renderers);
    }
}
