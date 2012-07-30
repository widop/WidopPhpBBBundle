<?php

/*
 * This file is part of the Widop package.
 *
 * (c) Widop <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\PhpBBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhpBB User.
 *
 * @ORM\Entity
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class User
{
    /**
     * @var integer The identifier.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type = "integer")
     */
    private $id;

    /**
     * @var string The username.
     *
     * @ORM\Column(
     *     type   = "string",
     *     length = 255
     * )
     */
    private $username;

    /**
     * @var string The password.
     *
     * @ORM\Column(
     *     type   = "string",
     *     length = 255
     * )
     */
    private $password;

    /**
     * @var string The email.
     *
     * @ORM\Column(
     *     type   = "string",
     *     length = 255
     * )
     */
    private $email;

    /**
     * Gets the identifier.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the username.
     *
     * @param string $username The username.
     *
     * @return \Widop\PhpBBBundle\Entity\User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Gets the password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password.
     *
     * @param string $password The password.
     *
     * @return \Widop\PhpBBBundle\Entity\User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Gets the email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email.
     *
     * @param string $email The email.
     *
     * @return \Widop\PhpBBBundle\Entity\User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
