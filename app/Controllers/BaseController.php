<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Smarty;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $_smarty;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $_data = [];
    protected $_session = [];

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
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->_session = \Config\Services::session();
       

        // Preload any models, libraries, etc, here.
        require_once(APPPATH.'smarty/libs/Smarty.class.php');
        $this->_smarty = new Smarty();
        $this->_smarty->setTemplateDir(APPPATH.'/Views/');
        $this->_smarty->setCompileDir(WRITEPATH.'cache');
        $this->_smarty->setCompileDir(WRITEPATH.'/cache/templates_c/');
        $this->_smarty->setConfigDir(WRITEPATH.'/cache/configs/');
        $this->_smarty->setCacheDir(WRITEPATH.'/cache/cache/');

        
        // E.g.: $this->session = \Config\Services::session();
    }
    public function display($strTemplate = 'layout.tpl'){
        // Assignation de toutes les variables au template
        foreach($this->_data as $key=>$value){
            $this->_smarty->assign($key, $value);
        }
        //$this->_smarty->debugging = true;
        $this->_smarty->display($strTemplate);
        // E.g.: $this->session = \Config\Services::session();
    }
}
