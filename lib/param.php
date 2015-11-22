<?php
    /**
     * Gets a parameter or default if not set
     *
     * Precedence is cookie->get->post
     *
     * @param $name string name of request
     * @param $default bool|string optional default to return if value is not found
     * @param $allowed string[] optional array of allowed values, if not in this
     *                 array, default will be returned
     * @return string
     */
    function param($name, $default = false, array $allowed = array()){
        $value = $default;

        if(isset($_COOKIE[$name])){
            $value = $_COOKIE[$name];
        }
        if(isset($_GET[$name])){
            $value = $_GET[$name];
        }
        if(isset($_POST[$name])){
            $value = $_POST[$name];
        }

        if(!empty($allowed) && !in_array($value, $allowed)){
            $value = $default;
        }
        return $value;
    }

    /**
     * Param, but casts to int
     */
    function intparam($name, $default = 0, array $allowed = array()){
        $value = param($name, $default, $allowed);
        if(!is_numeric($value)){
            $value = str_replace(',', '', $value);
        }
        if(!is_numeric($value)){
            return $default;
        }
        return $value;
    }

    /**
     * Param but htmlencodes the result
     */
    function safeparam($name, $default = false, array $allowed = array()){
        return htmlentities(param($name, $default, $allowed));
    }

    /**
     * Param, but forces array (if not supplied as array, forces one element array)
     */
    function arrayparam($name, $default = array()){
        $value = param($name, $default);
        if(!is_array($value)){
            $value = array($value);
        }
        return $value;
    }