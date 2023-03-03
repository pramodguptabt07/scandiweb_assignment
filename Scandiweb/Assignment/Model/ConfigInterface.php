<?php

namespace Scandiweb\Assignment\Model;

/**
 * Survey module configuration
 *
 */
interface ConfigInterface
{
    /**
     * Scandiweb Assignment Button
     */
    public const BUTTONCOLOR = 'scandiweb/assignment/button_color';

    /**
     * Get store config value for Scandiweb Assignment Button
     *
     * @return string
     */
    public function getStoreButtonColor();
}
