<?php

namespace Mock\Module {
    class StandardModule extends \Ray\Di\AbstractModule
    {
        public function configure()
        {
            $this->bind('BEAR\Sunday\Extension\Application\AppInterface')->to('Mock\App');
        }
    }
}

namespace Mock {

    use \BEAR\Sunday\Extension\Application\AppInterface;

    class App implements AppInterface
    {
    }
}

namespace BEAR\Package\Provide\Application {
    /**
     * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-28 at 09:50:50.
     */
    class ApplicationFactoryTest extends \PHPUnit_Framework_TestCase
    {
        /**
         * @var ApplicationFactory
         */
        protected $object;

        /**
         * Sets up the fixture, for example, opens a network connection.
         * This method is called before a test is executed.
         */
        protected function setUp()
        {
            $this->object = new ApplicationFactory;
        }

        /**
         * Tears down the fixture, for example, closes a network connection.
         * This method is called after a test is executed.
         */
        protected function tearDown()
        {
        }

        public function testNew()
        {
            $this->assertInstanceOf('BEAR\Package\Provide\Application\ApplicationFactory', $this->object);
        }

        /**
         * @covers BEAR\Package\Provide\Application\ApplicationFactory::setLoader
         */
        public function testSetLoader()
        {
            $object = $this->object->setLoader(dirname(dirname(dirname(__DIR__))));
            $this->assertInstanceOf('BEAR\Package\Provide\Application\ApplicationFactory', $object);
        }

        /**
         * @covers BEAR\Package\Provide\Application\ApplicationFactory::newInstance
         */
        public function testNewInstance()
        {
            $app = $this->object->newInstance('Mock', 'Standard');
            $this->assertInstanceOf('Mock\App', $app);
        }

        /**
         * @covers BEAR\Package\Provide\Application\ApplicationFactory::newInstance
         */
        public function testNewInstanceSandboxApp()
        {
            $app = $this->object->newInstance('Sandbox', 'Prod');
            $this->assertInstanceOf('Sandbox\App', $app);
        }
    }
}