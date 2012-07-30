<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\PhpBBBundle\Model;

use \Exception;

/**
 * Abstract PhpBB manager which allows to easily init PhpBB core.
 *
 * All PhpBB managers must extend this class.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPhpBBManager
{
    /**
     * @var boolean TRUE if the PhpBB core has been initilized else FALSE.
     */
    static protected $isInitialized = false;

    /**
     * PhpBB user manager constructor.
     *
     * @param string $phpBBPath The PhpBB path.
     */
    public function __construct($phpBBPath)
    {
        if (!is_dir($phpBBPath)) {
            throw new Exception(sprintf('The PhpBB path is not valid: %s', $phpBBPath));
        }

        $this->initPhpBB($phpBBPath);
    }

    /**
     * Initializes PhpBB core.
     *
     * @param string $phpBBPath The PhpBB path.
     */
    protected function initPhpBB($phpBBPath)
    {
        if (!self::$isInitialized) {
            global $phpbb_root_path, $phpEx, $db, $cache, $config, $user, $auth;

            if (!defined('IN_PHPBB')) {
                define('IN_PHPBB', true);
            }

            $phpbb_root_path = $phpBBPath.'/';
            $phpEx = substr(strrchr(__FILE__, '.'), 1);

            require_once $phpbb_root_path.'common.'.$phpEx;
            require_once $phpbb_root_path.'includes/functions_user.'.$phpEx;
        }

        self::$isInitialized = true;
    }
}
