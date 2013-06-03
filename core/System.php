<?php
namespace gladiator\core;

use gladiator\core\Bootstrap;
use gladiator\core\ConfigsManager;
use gladiator\core\Logger;
use gladiator\core\Output;
use gladiator\core\URI;

final class System {

	private static $instance = NULL;
	private $configsManager = NULL;
	private $logger = NULL;
	private $output = NULL;
	private $uri = NULL;
	CONST SYSTEM_VERSION = 'Gladiator 1.0';

	private function __construct() {
	}

	private function __clone() {

	}

	public function __toString() {

		return sprintf('');

	}

	public static function getInstance() {

		if (is_null(System::$instance)) {

			System::$instance = new self();
			Bootstrap::init(System::$instance);

		}

		return System::$instance;

	}

	public function getConfigsManager() {

		return $this->configsManager;

	}

	public function setConfigsManager(ConfigsManager $configsManager) {

		$this->configsManager = $configsManager;

	}

	public function getLogger() {

		return $this->logger;

	}

	public function setLogger(Logger $logger) {

		$this->logger = $logger;

	}

	public function getOutput() {

		return $this->output;

	}

	public function setOutput(Output $output) {

		$this->output = $output;

	}

	public function getURI() {

		return $this->uri;

	}

	public function setURI(URI $uri) {

		$this->uri = $uri;

	}

	public function executeRequest() {

		$uriSegments = $this->getURI()->getSegments();

		$realMVCPath = CONTROLLERS_PATH;
		
		if (count($uriSegments) > 0) {

			$realOffsetMVC = 0;

			foreach ($uriSegments as $segment) {

				if (is_dir($realMVCPath . $segment) === FALSE)
					break;

				$realOffsetMVC++;
				$realMVCPath .= $segment . '/';

			}

			//Load controller
			$MVCController = $realOffsetMVC++;

			$controllerName = isset($uriSegments[$MVCController]) ? $uriSegments[$MVCController] : 'Controller';
			$controllerPackage = $realMVCPath . $controllerName;
			$controllerFile = $controllerPackage . '.php';

			if (include_once($controllerFile)) {

				//Try to create the class
				if (class_exists($controllerName)) {

					$class = new $controllerName;

					$MVCMethod = $realOffsetMVC++;

					if (isset($uriSegments[$MVCMethod])) { // Call the method

						if (method_exists($class, $uriSegments[$MVCMethod])) {

							call_user_func_array(array($class, $uriSegments[$MVCMethod]), $this->getURI()->getSegments($MVCMethod + 1));

						} else {

							call_user_func_array(array($class, 'index'), $this->getURI()->getSegments($MVCMethod));

						}

					} else { //Call the default method

						call_user_func(array($class, 'index'));

					}

				} else {

					throw new \RuntimeException("The class $controllerName was not found in $controllerFile ");

				}

			} else {

				throw new \RuntimeException("Any controller was found in $realMVCPath");

			}

		} else { //Try to load the default folder controller

			$controllerName = 'Controller';
			$controllerPackage = $realMVCPath . $controllerName;
			$controllerFile = $controllerPackage . '.php';

			if (include_once($controllerFile)) {

				//Try to create the class
				if (class_exists($controllerName)) {

					$class = new $controllerName;

					$MVCMethodName = 'index';

					if (method_exists($class, $MVCMethodName)) {

						call_user_func( array($class, $MVCMethodName) );

					} else {

						throw new \RuntimeException("The class Controller.php must to have a method called 'index' ");

					}

				} else {

					throw new \RuntimeException("The class $controllerName was not found in $controllerFile ");

				}

			} else {

				throw new \RuntimeException("There is not any Controller.php");

			}

		}

	}

}
