<?php
namespace Crabstudio\Test\TestCase\Model\Behavior;

use Crabstudio\Sluggable\Model\Behavior\SluggableBehavior;
use Cake\TestSuite\TestCase;

/**
 * SluggableBehavior Test Case
 */
class SluggableBehaviorTest extends TestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sluggable = new SluggableBehavior();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sluggable);

		parent::tearDown();
	}

}
