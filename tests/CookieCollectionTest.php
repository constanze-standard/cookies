<?php
namespace ConstanzeStandard\Cookies;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

if (!defined('TIME_DEFINED')) {
    function time()
    {
        return strtotime('12:00');
    }
    define('TIME_DEFINED', true);
}

require_once __DIR__ . '/AbstractTest.php';

class CookieCollectionTest extends \AbstractTest
{
    public function testAdd()
    {
        $cookieCollection = new CookieCollection('domain', true);
        $cookie = $cookieCollection->add('name', 'value', 120, '/', null, null, true);
        $this->assertInstanceOf(Cookie::class, $cookie);
        $this->assertEquals($cookie->getName(), 'name');
        $this->assertEquals($cookie->getValue(), 'value');
        $this->assertEquals($cookie->getPath(), '/');
        $this->assertEquals($cookie->getDomain(), 'domain');
        $this->assertEquals($cookie->isSecure(), true);
        $this->assertEquals($cookie->isHttponly(), true);
        $this->assertEquals($cookie->getExpire(), time() + 120);
    }

    public function testMakeResponse()
    {
        $response = new Response();
        $cookieCollection = new CookieCollection();
        $cookie = $cookieCollection->add('name', 'value', 120, '/', 'domain', true, true);
        $result = $cookieCollection->makeResponse($response);

        $this->assertInstanceOf(ResponseInterface::class, $result);

        $cookies = $result->getHeader('Set-Cookie');
        $gmd = gmdate(\DateTime::COOKIE, $cookie->getExpire());
        $hl = "name=value;Expires=$gmd;Max-Age=120;Path=/;Domain=domain;Secure;HttpOnly";
        $this->assertEquals($cookies, [$hl]);
    }
}
