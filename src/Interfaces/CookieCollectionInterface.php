<?php

namespace ConstanzeStandard\Cookies\Interfaces;

use Psr\Http\Message\ResponseInterface;

interface CookieCollectionInterface
{
    /**
     * Add a cookie with args.
     * 
     * @param string $name The name of the cookie.
     * @param string $value The value of the cookie.
     * @param int $expireTime The time of cookie expires relatively to current timestamp.
     * @param string $path The path on the server in which the cookie will be available on.
     * @param string $domain The (sub)domain that the cookie is available to.
     * @param bool $secure Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client.
     * @param bool $httponly When TRUE the cookie will be made accessible only through the HTTP protocol.
     * 
     * @return CookieInterface
     */
    public function add(
        string $name,
        string $value = '',
        int $expireTime = 0,
        string $path = '',
        string $domain = '',
        bool $secure = false,
        bool $httponly = false
    ): CookieInterface;

    /**
     * Add a cookie to collection.
     * 
     * @param CookieInterface $cookie
     * 
     * @return CookieInterface
     */
    public function addCookie(CookieInterface $cookie): CookieInterface;

    /**
     * Make a new response with `Set-Cookie` header.
     * 
     * @param ResponseInterface $response
     * 
     * @return ResponseInterface
     */
    public function makeResponse(ResponseInterface $response): ResponseInterface;
}
