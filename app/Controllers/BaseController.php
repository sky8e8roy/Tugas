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

use App\Models\Joindata;
use App\Models\Modeljenisdata;
use CodeIgniter\Controller;

use App\Models\Modelkabupaten;
use App\Models\Modelkampung;
use App\Models\Modelkecamatan;
use App\Models\Modelriwayatkab;
use App\Models\Modelsatker;
use App\Models\Modelsatuan;
use App\Models\Modelsektor;
use App\Models\Modelsubsektor;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		$this->kab = new Modelkabupaten;
		$this->kec = new Modelkecamatan;
		$this->kp = new Modelkampung();
		$this->joda = new Joindata();
		$this->satker = new Modelsatker();
		$this->sek = new Modelsektor();
		$this->subsek = new Modelsubsektor();
		$this->sat = new Modelsatuan();
		$this->jenisdata = new Modeljenisdata();
		$this->rkab = new Modelriwayatkab();

	}

}
