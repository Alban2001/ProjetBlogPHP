<?php

namespace Lib;

class Globals
{
    /**
     * Variable globale POST
     *
     * @var mixed
     */
    private $POST;

    /**
     * Variable globale GET
     *
     * @var mixed
     */
    private $GET;

    /**
     * Variable globale ENV
     *
     * @var mixed
     */
    private $_ENV;

    /**
     * Variable globale SESSION
     *
     * @var mixed
     */
    private $_SESSION;

    /**
     * Variable globale FILES
     *
     * @var mixed
     */
    private $_FILES;

    // private function define_superglobals()
    // {
    //     $this->_ENV = (isset($_ENV)) ? $_ENV : null;
    //     $this->_SESSION = (isset($_SESSION)) ? $_SESSION : null;
    // }

    /**
     * Method setPOST
     *
     * @param array $options [explicite description]
     *
     * @return void
     */
    public function setPOST(array $options = null)
    {
        if ($options !== null) {
            $this->POST = filter_input_array(INPUT_POST, $options) ?? null;
        }
        $this->POST = filter_input_array(INPUT_POST, FILTER_DEFAULT) ?? null;
    }

    /**
     * Method getPOST
     *
     * @param $key $key [explicite description]
     *
     * @return array
     */
    public function getPOST($key = null)
    {
        if ($key !== null) {
            return $this->POST[$key] ?? null;
        }
        return $this->POST;
    }

    /**
     * Method setFILES
     *
     * @return void
     */
    public function setFILES()
    {
        $this->_FILES = (isset($_FILES)) ? $_FILES : null;
    }

    /**
     * Method getFILES
     *
     * @param $key $key [explicite description]
     *
     * @return array
     */
    public function getFILES($key = null)
    {
        if ($key !== null) {
            return $this->_FILES[$key] ?? null;
        }
        return $this->_FILES;
    }

    /**
     * Method setGET
     *
     * @param array $options [explicite description]
     *
     * @return void
     */
    public function setGET(array $options = null)
    {
        if ($options !== null) {
            $this->GET = filter_input_array(INPUT_GET, $options) ?? null;
        }
        $this->GET = filter_input_array(INPUT_GET, FILTER_DEFAULT) ?? null;
    }

    /**
     * Method getGET
     *
     * @param $key $key [explicite description]
     *
     * @return array
     */
    public function getGET($key = null)
    {
        if ($key !== null) {
            return $this->GET[$key] ?? null;
        }
        return $this->GET;
    }

    // // VARIABLES GLOBALES SESSION
    // public function setSESSION()
    // {
    //     $this->SESSION = $_SESSION;
    // }

    // public function getSESSION($key = null, $key2 = null)
    // {
    //     if ($key !== null && $key2 !== null) {
    //         return $this->SESSION[$key][$key2] ?? null;
    //     }
    //     return $this->SESSION;
    // }


    // // VARIABLES GLOBALES POST
    // public function setENV($key, $value)
    // {
    //     $this->ENV[$key] = $value;
    // }

    // public function getENV($key = null)
    // {
    //     if ($key !== null) {
    //         return $this->ENV[$key] ?? null;
    //     }
    //     return $this->ENV;
    // }
}