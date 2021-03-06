<?php
namespace BEAR\Package\Module\Resource\Interceptor;

use BEAR\Package\Module\Resource\Interceptor\ResourceGraph;
use BEAR\Resource\AbstractObject;
use BEAR\Resource\Adapter\Http;
use BEAR\Resource\SchemeCollection;
use Ray\Aop\ReflectiveMethodInvocation;
use Ray\Di\Annotation;
use Ray\Di\Config;
use Ray\Di\Container;
use Ray\Di\Definition;
use Ray\Di\Forge;
use Ray\Di\Injector;
use Doctrine\Common\Annotations\AnnotationReader;
use BEAR\Resource\Adapter\AdapterInterface;

use BEAR\Resource\Request;
use BEAR\Resource\Adapter\App;

class Foo extends AbstractObject
{
    public $body = [
        'bar'=> 'http://www.w3.org/standards/webdesign/accessibility'
    ];

    /**
     * ResourceGraph
     */
    public function onGet()
    {
        return $this;
    }
}

class DummyAdapter implements AdapterInterface
{
}

class ResourceGraphTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ResourceGraph
     */
    private $resourceGraph;

    public function setUp()
    {
        $resource = require $GLOBALS['_BEAR_PACKAGE_DIR'] . '/vendor/bear/resource/scripts/instance.php';
        /** @var $resource \BEAR\Resource\Resource */
        $injector = new Injector(new Container(new Forge(new Config(new Annotation(new Definition, new AnnotationReader)))));
        $scheme = new SchemeCollection;
        $scheme->scheme('http')->host('*')->toAdapter(
            new Http
        );
        $resource->setSchemeCollection($scheme);
        $this->resourceGraph = new ResourceGraph($resource);
    }

    public function testNew()
    {
        $this->assertInstanceOf('BEAR\Package\Module\Resource\Interceptor\ResourceGraph', $this->resourceGraph);
    }

    public function testInvoke()
    {
        $foo = new Foo;
        $invocation = new ReflectiveMethodInvocation([$foo, 'onGet'], [], [$this->resourceGraph]);
        $this->resourceGraph->invoke($invocation);
        $request = $foo->body['bar'];
        $this->assertInstanceOf('BEAR\Resource\Request', $request);

        return $request;
    }

    /**
     * @depends testInvoke
     */
    public function testRequest(Request $request)
    {
        $this->assertSame('http://www.w3.org/standards/webdesign/accessibility', $request->uri);
    }
}
