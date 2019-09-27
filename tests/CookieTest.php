<?php
namespace ConstanzeStandard\Cookies;

if (!defined('TIME_DEFINED')) {
    function time()
    {
        return strtotime('12:00');
    }
    define('TIME_DEFINED', true);
}

require_once __DIR__ . '/AbstractTest.php';

class CookieTest extends \AbstractTest
{
    public function testGet()
    {
        $cookie = new Cookie('name', 'value', 120, '/', 'domain', true, true);
        $this->assertEquals($cookie->getName(), 'name');
        $this->assertEquals($cookie->getValue(), 'value');
        $this->assertEquals($cookie->getPath(), '/');
        $this->assertEquals($cookie->getDomain(), 'domain');
        $this->assertEquals($cookie->isSecure(), true);
        $this->assertEquals($cookie->isHttponly(), true);
        $this->assertEquals($cookie->getExpire(), time() + 120);

        $gmd = gmdate(\DateTime::COOKIE, $cookie->getExpire());
        $hl = "name=value;Expires=$gmd;Max-Age=120;Path=/;Domain=domain;Secure;HttpOnly";
        $this->assertEquals($cookie->getHeaderLine(), $hl);
    }
}
