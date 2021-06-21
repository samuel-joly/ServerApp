<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use CodeIgniter\Validation\Exceptions\ValidationException;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;


class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->validator = Services::Validation();
	}

	public function getResponse(array $resBody, int $code = ResponseInterface::HTTP_OK)
	{
		return $this->response
							 ->setStatusCode($code)
							 ->setJSON($resBody);
	}

	public function getRequest(IncomingRequest $request)
	{
		$input = $request->getPost();
		if(empty($input))
		{
			$input = $request->getGet();
			if(empty($input))
			{
				$input = json_decode($request->getBody(),true);
				if(empty($input))
				{
					$input = $request->getRawInput();
				}
			}
		}
		return $input;
	}

	public function validateRequest($input, array $rules, array $message = [])
	{
		if(is_string($rules))
		{
			$validation = config('Validation');

			if(!isset($validation->$rules))
			{
				throw ValidationException::forRuleNotFound($rules);
			}

			if(empty($message))
			{
				$errorName =  $rules . "_error";
				$message = $validation->$errorName ?? [];
			}
			$rules = $validation->$rules;
		}

		return $this->validator->setRules($rules, $message)->run($input);
	}


}
