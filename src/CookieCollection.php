<?php

namespace ConstanzeStandard\Cookies;

use ConstanzeStandard\Cookies\Interfaces\CookieCollectionInterface;
use ConstanzeStandard\Cookies\Interfaces\CookieInterface;
use Psr\Http\Message\ResponseInterface;

class CookieCollection implements CookieCollectionInterface
{
    /**
     * Cookies
     * 
     * @var CookieInterface[]
     */
    private $cookies = [];

    /**
     * The default domain.
     * 
     * @var string
     */
    private $domain;

    /**
     * The default secure.
     * 
     * @var bool
     */
    private $secure;

    /**
     * @param string $domain
     * @param bool $secure
     */
    public function __construct(string $domain = '', bool $secure = false)
    {
        $this->domain = $domain;
        $this->secure = $secure;
    }

    /**
     * Add a cookie with args.
     * 
     * @param string $name The name of the cookie.
     * @param string $value The value of the cookie.
     * @param int $expireTime The time of cookie expires relatively to current timestamp.
     * @param string $path The path on the server in which the cookie will be available on.
     * @param string|null $domain The (sub)domain that the cookie is available to.
     * @param bool|null $secure Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client.
     * @param bool $httponly When TRUE the cookie will be made accessible only through the HTTP protocol.
     * 
     * @return CookieInterface
     */
    public function add(
        string $name,
        string $value = '',
        int $expireTime = 0,
        string $path = '',
        ?string $domain = null,
        ?bool $secure = null,
        bool $httponly = false
    ): CookieInterface
    {
        $cookie = new Cookie(
            $name,
            $value,
            $expireTime,
            $path,
            $domain ?? $this->domain,
            $secure ?? $this->secure,
            $httponly
        );
        return $this->addCookie($cookie);
    }

    /**
     * Add a cookie to collection.
     * 
     * @param CookieInterface $cookie
     * 
     * @return CookieInterface
     */
    public function addCookie(CookieInterface $cookie): CookieInterface
    {
        $this->cookies[] = $cookie;
        return $cookie;
    }

    /**
     * Make a new response with `Set-Cookie` header.
     * 
     * @param ResponseInterface $response
     * 
     * @return ResponseInterface
     */
    public function makeResponse(ResponseInterface $response): ResponseInterface
    {
        $headerLines = [];
        foreach ($this->cookies as $cookie) {
            $headerLines[] = $cookie->getHeaderLine();
        }

        return $response->withAddedHeader('Set-Cookie', $headerLines);
    }
}
