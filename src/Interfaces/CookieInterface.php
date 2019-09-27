<?php

namespace ConstanzeStandard\Cookies\Interfaces;

interface CookieInterface
{
    /**
     * Get the name of the cookie.
     * 
     * @return string
     */
    public function getName(): string;

    /**
     * Get the value of the cookie.
     * 
     * @return string
     */
    public function getValue(): string;

    /**
     * Get the time the cookie expires.
     * 
     * @return string
     */
    public function getExpire(): int;

    /**
     * Get the path on the server in which the cookie will be available on.
     * 
     * @return string
     */
    public function getPath(): string;

    /**
     * Get the (sub)domain that the cookie is available to.
     * 
     * @return string
     */
    public function getDomain(): string;

    /**
     * Get should cookie only be transmitted over a secure HTTPS connection from the client
     * 
     * @return bool
     */
    public function isSecure(): bool;

    /**
     * When TRUE the cookie will be made accessible only through the HTTP protocol.
     * 
     * @return bool
     */
    public function isHttponly(): bool;

    /**
     * Get the cookie header line.
     * 
     * @return string
     */
    public function getHeaderLine(): string;
}
