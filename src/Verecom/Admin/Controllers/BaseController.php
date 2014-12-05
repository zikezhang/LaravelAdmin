<?php namespace Verecom\Admin\Controllers;

use Controller;
use View;
use Config;

class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
        //share the config option to all the views
        View::share('admin', Config::get('admin::site_config'));
    }

    /**
     * get the validation service
     *
     * @author ZZk
     * @link   http://verecom.com
     *
     * @param  string $service
     * @param  array $inputs
     * @return Object
     */
    protected function getValidationService($service, array $inputs = array())
    {
        $class = '\\'.ltrim(Config::get("admin::validation.{$service}"), '\\');
        return new $class($inputs);
    }

}
