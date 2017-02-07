<?php
/**
 * SettingTest plugin for Craft CMS 3.x
 *
 * Test of settings page.
 *
 * @link      http://johnfmorton.com
 * @copyright Copyright (c) 2017 John F Morton
 */

namespace johnfmorton\settingtest;

use johnfmorton\settingtest\models\Settings;

use Craft;
use craft\base\Plugin;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 *
 * @author    John F Morton
 * @package   SettingTest
 * @since     0.0.1
 */
class SettingTest extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * SettingTest::$plugin
     *
     * @var static
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * Set our $plugin static property to this class so that it can be accessed via
     * SettingTest::$plugin
     *
     * Called after the plugin class is instantiated; do any one-time initialization
     * here such as hooks and events.
     *
     * If you have a '/vendor/autoload.php' file, it will be loaded for you automatically;
     * you do not need to load it in your init() method.
     *
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // If I've set 'someField' to something other than the default,
        // traceing out the entire 'settings' will show that the new
        // value is stored there...
        Craft::trace($this->settings, __METHOD__);

        // someField is defined in models/Settings.php
        // but, if I try to access the 'someField' like this,
        // it alwasy returns the default value instead although
        // I expected to get the custom value I'd set
        Craft::trace($this->settings->someField, __METHOD__);

        /**
         * Logging in Craft involves using one of the following methods:
         *
         * Craft::trace(): record a message to trace how a piece of code runs. This is mainly for development use.
         * Craft::info(): record a message that conveys some useful information.
         * Craft::warning(): record a warning message that indicates something unexpected has happened.
         * Craft::error(): record a fatal error that should be investigated as soon as possible.
         *
         * Unless `devMode` is on, only Craft::warning() & Craft::error() will log to `craft/storage/logs/web.log`
         *
         * It's recommended that you pass in the magic constant `__METHOD__` as the second parameter, which sets
         * the category to the method (prefixed with the fully qualified class name) where the constant appears.
         *
         * To enable the Yii debug toolbar, go to your user account in the AdminCP and check the
         * [] Show the debug toolbar on the front end & [] Show the debug toolbar on the Control Panel
         *
         * http://www.yiiframework.com/doc-2.0/guide-runtime-logging.html
         */
        
        Craft::info('SettingTest ' . Craft::t('settingTest', 'plugin loaded'), __METHOD__);
    }

    // Protected Methods
    // =========================================================================

    /**
     * Performs actions before the plugin is installed.
     *
     * @return bool Whether the plugin should be installed
     */
    protected function beforeInstall(): bool
    {
        return true;
    }

    /**
     * Performs actions after the plugin is installed.
     */
    protected function afterInstall()
    {
    }

    /**
     * Performs actions before the plugin is updated.
     *
     * @return bool Whether the plugin should be updated
     */
    protected function beforeUpdate(): bool
    {
        return true;
    }

    /**
     * Performs actions after the plugin is updated.
     */
    protected function afterUpdate()
    {
    }

    /**
     * Performs actions before the plugin is installed.
     *
     * @return bool Whether the plugin should be installed
     */
    protected function beforeUninstall(): bool
    {
        return true;
    }

    /**
     * Performs actions after the plugin is installed.
     */
    protected function afterUninstall()
    {
    }

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'settingtest'
            . DIRECTORY_SEPARATOR
            . 'settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
