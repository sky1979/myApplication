<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_EventManager
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend\EventManager;

use Zend\Stdlib\CallbackHandler;

/**
 * Static version of EventManager
 *
 * @category   Zend
 * @package    Zend_EventManager
 * @copyright  Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class StaticEventManager extends SharedEventManager
{
    /**
     * @var StaticEventManager
     */
    protected static $instance;

    /**
     * Singleton
     * 
     * @return void
     */
    protected function __construct()
    {
    }

    /**
     * Singleton
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Retrieve instance
     * 
     * @return StaticEventManager
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Reset the singleton instance
     * 
     * @return void
     */
    public static function resetInstance()
    {
        self::$instance = null;
    }
}