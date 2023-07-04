<?php

namespace Lib;

class Globals
{
    private $POST;
    private $GET;
    private $SESSION;

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
    public function getGET($key = null)
    {
        if ($key !== null) {
            return $this->GET[$key] ?? null;
        }
        return $this->GET;
    }
    public function getSESSION($key = null, $key2 = null)
    {
        if ($key !== null && $key2 !== null) {
            return $this->SESSION[$key][$key2] ?? null;
        }
        return $this->SESSION;
    }
}