<?php

class BaseController extends Controller
{
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
	}

  /**
   * Debug Input:all()
   */
  protected function debug($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    return exit;
  }

}