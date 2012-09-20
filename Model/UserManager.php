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
 * PhpBB user manager.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class UserManager extends AbstractPhpBBManager
{
    /**
     * Adds a user to PhpBB.
     *
     * @param string  $username The user username.
     * @param string  $password The user password (encoded).
     * @param string  $email    The user email.
     * @param integer $group    The user group (group id).
     * @param integer $type     The user type.
     */
    public function addUser($username, $password, $email, $group, $type)
    {
        $this->initPhpBB();

        $errorReporting = error_reporting(E_ALL - E_NOTICE);

        $userRow = array(
            'username'      => $username,
            'user_password' => $password,
            'user_email'    => $email,
            'group_id'      => $group,
            'user_type'     => $type,
        );

        user_add($userRow);

        error_reporting($errorReporting);
    }

    /**
     * Updates the PhpBB user password & email.
     *
     * @param string $username    The username of the user to edit.
     * @param string $newPassword The new password (crypted).
     * @param string $newEmail    The new email.
     */
    public function updateUser($username, $newPassword, $newEmail)
    {
        $this->initPhpBB();

        global $db;

        $sql = 'UPDATE '.USERS_TABLE.' '.
               'SET user_password = "'.$db->sql_escape($newPassword).'", '.
               'user_email = "'.$db->sql_escape($newEmail).'" '.
               'WHERE user_id = "'.$this->getUserId($username).'"';

        $db->sql_query($sql);
    }

    /**
     * Removes a PhpBB user.
     *
     * @param string $username The user name.
     */
    public function removeUser($username)
    {
        $this->initPhpBB();

        user_delete('remove', $this->getUserId($username));
    }

    /**
     * Gets the user id according to the username.
     *
     * @param string $username The username.
     *
     * @return integer The user id.
     */
    public function getUserId($username)
    {
        $this->initPhpBB();

        $userIds = array();
        $userNames = array($username);

        user_get_id_name($userIds, $userNames);

        if (!isset($userIds[0])) {
            throw new Exception(sprintf('The user "%s" does not exist.', $username));
        }

        return $userIds[0];
    }

    /**
     * Encodes a plain password according to phpBB password hash.
     *
     * @param string $plainPassword The plain password.
     *
     * @return string The encoded password.
     */
    public function encodePassword($plainPassword)
    {
        $this->initPhpBB();

        return phpbb_hash($plainPassword);
    }
}
