<?php
App::uses('View', 'View');
App::uses('Helper', 'View');
App::uses('AuthHelper', 'AuthHelper.View/Helper');
App::uses('ComponentCollection', 'Controller');
App::uses('AuthComponent', 'Controller/Component');

/**
 * AuthHelper Test Case
 *
 */
class AuthHelperTest extends CakeTestCase {

	public $fixtures = array('core.user', 'core.auth_user');
	public $Collection;
	public $request;
	public $View;
	public $AuthComponent;
	public $Auth; // helper in doubt

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();
		$this->View = new View();
		$this->Collection = new ComponentCollection();
		$this->request = new CakeRequest(null, false);
		$this->AuthComponent = new AuthComponent($this->Collection);
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		parent::tearDown();
	}

	/**
	* Test the constructor
	*
	* @return void
	*/
	public function testConstructor() {
		$this->Auth = new AuthHelper($this->View, array('Auth'=>$this->AuthComponent));
		$this->assertEquals('AuthComponent', get_class($this->Auth->Auth));
	}

	/**
	 * test is_allowed method
	 *
	 * @return void
	 */
	public function testIsAllowed() {
		$this->Auth = new AuthHelper($this->View, array('Auth'=>$this->AuthComponent));
		$this->assertEquals(false, $this->Auth->is_allowed('/rooms', AuthComponent::user()));
	}

}
