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

use Symfony\Component\HttpKernel\Kernel;

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
     * @var string The php bb path (in config)
     */
    private $phpbbPath;

    /**
     * @var \Symfony\Component\HttpKernel\Kernel The current kernel.
     */
    private $kernel;

    /**
     * PhpBB user manager constructor.
     *
     * @param string $phpBBPath The PhpBB path.
     */
    public function __construct($phpBBPath, Kernel $kernel)
    {
        if (!is_dir($phpBBPath)) {
            throw new Exception(sprintf('The PhpBB path is not valid: %s', $phpBBPath));
        }

        $this->phpbbPath = $phpBBPath;
        $this->kernel = $kernel;
    }

    /**
     * Initializes PhpBB core.
     */
    protected function initPhpBB()
    {
        if (!self::$isInitialized) {
            global $phpbb_root_path, $phpEx, $db, $cache, $config, $user, $auth, $kernel;

            $kernel = $this->kernel;

            if (!defined('IN_PHPBB')) {
                define('IN_PHPBB', true);
            }

            $phpbb_root_path = $this->phpbbPath.'/';
            $phpEx = substr(strrchr(__FILE__, '.'), 1);

            require_once $phpbb_root_path.'common.'.$phpEx;
            require_once $phpbb_root_path.'includes/functions_user.'.$phpEx;
        }

        self::$isInitialized = true;
    }
}
