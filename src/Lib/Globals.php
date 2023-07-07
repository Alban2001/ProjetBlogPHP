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
    private $FILES;

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
        $this->FILES = filter_var_array($_FILES, FILTER_DEFAULT);
    }

    /**
     * Method getFILES
     *
     * @param $key $key [explicite description]
     *
     * @return array
     */
    public function getFILES()
    {
        return $this->FILES;
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

    public function getENV($key = null)
    {
        if ($key !== null) {
            return $this->_ENV[$key] ?? null;
        }
        return $this->_ENV;
    }
}