<?php
/**
 * Deeson Frontend Framework plugin for Craft CMS 3.x
 *
 * Makes craft work with the Deeson Frontend framework
 *
 * @link      deeson.co.uk
 * @copyright Copyright (c) 2020 Peter Berryman
 */

namespace deeson\deesonfrontendframework;


use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;

use yii\base\Event;

/**
 * Class DeesonFrontendFramework
 *
 * @author    Peter Berryman
 * @package   DeesonFrontendFramework
 * @since     1.0.0
 *
 */
class DeesonFrontendFramework extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var DeesonFrontendFramework
     */
    public static $plugin;

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    /**
     * @var bool
     */
    public $hasCpSettings = false;

    /**
     * @var bool
     */
    public $hasCpSection = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Event::on(
            View::class,
            View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots['%components'] = CRAFT_BASE_PATH . '/src/components';
            }
        );

        Craft::info(
            Craft::t(
                'deeson-craft-frontend-framework',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
