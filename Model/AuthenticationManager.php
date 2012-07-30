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

/**
 * Authentication manager.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AuthenticationManager extends AbstractPhpBBManager
{
    /**
     * Login the user on PhpBB.
     *
     * @param string $username The username.
     * @param string $password The user password.
     */
    public function login($username, $password, $rememberMe = false)
    {
        global $user, $auth;

        $user->session_begin();
        $auth->login($username, $password, $rememberMe);
    }

    /**
     * Logout the user on PhpBB.
     */
    public function logout()
    {
        global $user;

        $user->session_kill();
        $user->session_begin();
    }
}
