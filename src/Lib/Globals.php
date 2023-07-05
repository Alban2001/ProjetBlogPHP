<?php

namespace Lib;

class Globals
{
    // Variable $_POST
    private $POST;

    // Variable $_GET
    private $GET;

    // Variable $_SESSION
    private $SESSION;

    // Variable $_FILES
    private $FILES;

    // VARIABLES GLOBALES POST
    public function setPOST(array $options = null)
    {
        if ($options !== null) {
            $this->POST = filter_input_array(INPUT_POST, $options) ?? null;
        }
        $this->POST = filter_input_array(INPUT_POST, FILTER_DEFAULT) ?? null;
    }

    public function getPOST($key = null)
    {
        if ($key !== null) {
            return $this->POST[$key] ?? null;
        }
        return $this->POST;
    }

    // VARIABLES GLOBALES FILES
    public function setFILES()
    {
        $this->FILES = $_FILES;
    }

    public function getFILES($key = null)
    {
        if ($key !== null) {
            return $this->FILES[$key] ?? null;
        }
        return $this->FILES;
    }

    // VARIABLES GLOBALES GET
    public function setGET(array $options = null)
    {
        if ($options !== null) {
            $this->GET = filter_input_array(INPUT_GET, $options) ?? null;
        }
        $this->GET = filter_input_array(INPUT_GET, FILTER_DEFAULT) ?? null;
    }

    public function getGET($key = null)
    {
        if ($key !== null) {
            return $this->GET[$key] ?? null;
        }
        return $this->GET;
    }

    // VARIABLES GLOBALES SESSION
    public function setSESSION()
    {
        $this->SESSION = $_SESSION;
    }

    public function getSESSION($key = null, $key2 = null)
    {
        if ($key !== null && $key2 !== null) {
            return $this->SESSION[$key][$key2] ?? null;
        }
        return $this->SESSION;
    }
}