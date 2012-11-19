<?php

namespace Landmarx\Bundle\LandmarxBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This compiler pass registers the renderers in the RendererProvider.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class AddVotersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('landmarx_landmark.matcher')) {
            return;
        }

        $definition = $container->getDefinition('landmarx_landmark.matcher');
        $listener = $container->getDefinition('landmarx_landmark.listener.voters');

        foreach ($container->findTaggedServiceIds('landmarx_landmark.voter') as $id => $tags) {
            $definition->addMethodCall('addVoter', array(new Reference($id)));

            foreach ($tags as $tag) {
                if (isset($tag['request']) && $tag['request']) {
                    $listener->addMethodCall('addVoter', array(new Reference($id)));
                }
            }
        }
    }
}
