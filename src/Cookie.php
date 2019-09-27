<?php

namespace ConstanzeStandard\Cookies;

use ConstanzeStandard\Cookies\Interfaces\CookieInterface;

class Cookie implements CookieInterface
{
    /**
     * The name of the cookie.
     * 
     * @var string
     */
    private $name;

    /**
     * The value of the cookie.
     * 
     * @var string
     */
    private $value;

    /**
     * The time the cookie expire time.
     * 
     * @var int
     */
    private $expireTime;

    /**
     * The path on the server in which the cookie will be available on.
     * 
     * @var string
     */
    private $path;

    /**
     * The (sub)domain that the cookie is available to.
     * 
     * @var string
     */
    private $domain;

    /**
     * Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client.
     * 
     * @var bool
     */
    private $secure;

    /**
     * When TRUE the cookie will be made accessible only through the HTTP protocol.
     * 
     * @var bool
     */
    private $httponly;

    /**
     * @param string $name The name of the cookie.
     * @param string $value The value of the cookie.
     * @param int $expireTime The time of cookie expires relatively to current timestamp.
     * @param string $path The path on the server in which the cookie will be available on.
     * @param string $domain The (sub)domain that the cookie is available to.
     * @param bool $secure Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client.
     * @param bool $httponly When TRUE the cookie will be made accessible only through the HTTP protocol.
     */
    public function __construct(
        string $name,
        string $value = '',
        int $expireTime = null,
        string $path = '',
        string $domain = '',
        bool $secure = false,
        bool $httponly = false
    )
    {
        $this->name = $name;
        $this->value = $value;
        $this->expireTime = $expireTime;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httponly = $httponly;
    }

    /**
     * Get the name of the cookie.
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of the cookie.
     * 
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Get the time the cookie expires.
     * 
     * @return string
     */
    public function getExpire(): int
    {
        return $this->expireTime ? time() + $this->expireTime : 0;
    }

    /**
     * Get the path on the server in which the cookie will be available on.
     * 
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Get the (sub)domain that the cookie is available to.
     * 
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * Get should cookie only be transmitted over a secure HTTPS connection from the client
     * 
     * @return bool
     */
    public function isSecure(): bool
    {
        return $this->secure;
    }

    /**
     * When TRUE the cookie will be made accessible only through the HTTP protocol.
     * 
     * @return bool
     */
    public function isHttponly(): bool
    {
        return $this->httponly;
    }

    /**
     * Get the cookie header line.
     * 
     * @return string
     */
    public function getHeaderLine(): string
    {
        $headerLine = sprintf('%s=%s', rawurlencode($this->name), rawurlencode($this->value));
        if ($this->expireTime) {
            $headerLine .= ';Expires=' . gmdate(\DateTime::COOKIE, $this->getExpire());
            $headerLine .= ';Max-Age=' . $this->expireTime;
        }

        if ($this->path) {
            $headerLine .= ';Path=' . $this->path;
        }

        if ($this->domain) {
            $headerLine .= ';Domain=' . $this->domain;
        }

        if ($this->secure) {
            $headerLine .= ';Secure';
        }

        if ($this->httponly) {
            $headerLine .= ';HttpOnly';
        }
        return $headerLine;
    }
}
