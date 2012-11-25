<?php

namespace Landmarx\Bundle\LandmarxBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper as TemplatingHelper;
use Landmarx\Landmark\Twig\Helper;

class LandmarkHelper extends TemplatingHelper
{
    private $helper;

    /**
     * @param \Landmarx\Landmark\Twig\Helper $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Retrieves an item following a path in the tree.
     *
     * @param \Landmarx\Landmark\ItemInterface|string $landmark
     * @param array $path
     * @param array $options
     * @return \Landmarx\Landmark\ItemInterface
     */
    public function get($landmark, array $path = array(), array $options = array())
    {
        return $this->helper->get($landmark, $path, $options);
    }

    /**
     * Renders a landmark with the specified renderer.
     *
     * @param \Landmarx\Landmark\ItemInterface|string|array $landmark
     * @param array $options
     * @param string $renderer
     * @return string
     */
    public function render($landmark, array $options = array(), $renderer = null)
    {
        return $this->helper->render($landmark, $options, $renderer);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'landmarx_landmark';
    }
}
