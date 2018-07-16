<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\FroalaHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\FroalaHelper Test Case
 */
class FroalaHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\FroalaHelper
     */
    public $Froala;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Froala = new FroalaHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Froala);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
