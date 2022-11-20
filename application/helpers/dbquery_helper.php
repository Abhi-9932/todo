<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function single_get($id = '')
    {
        return base64_decode($id);
    }   
}