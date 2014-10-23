<?php
/**
 * This helper adds the ability to check current user against Auth::authorize objects
 *
 * @copyright Copyright (c) Jan Ptacek (https://twitter.com/ptica)
 * @link https://github.com/ptica
 * @package app.View.Helper
 * @version 1.0.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * @author Jan Ptacek (jan.ptacek@gmail.com)
 */

App::uses('Router', 'Routing');
App::uses('AppHelper', 'View/Helper');

/**
 * Class AuthHelper
 *
 * @package app.View.Helper
 */
class AuthHelper extends AppHelper {

    public $Auth;

    /**
     * Constructor
     */
	public function __construct(View $view, $settings = array()) {
		parent::__construct($view, $settings);
        $this->Auth = $settings['Auth'];
	}

    public function is_allowed($url, $user=null) {
        if ($user === null) {
            $user = AuthComponent::user();
        }
        // TODO account for $this->Auth->allow() as well
        // so far I just duplicate the allow in acl.ini of TinyAuthorize

        // $request creation seems to be heavyweight ;(
        $request = new CakeRequest($url, $parseEnvironment = false);
        Router::setRequestInfo($request);
        $params = Router::parse($request->url);
        $request->addParams($params);
        // AuthComponent::isAuthorized calls Auth::authorize_objects::authorize
        // TinyAuthorize needs
        // $request->params['plugin']
        // $request->params['controller']
        // $request->params['action']
        return $this->Auth->isAuthorized($user, $request);
    }
}
