<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('gerarToken')) {
    function gerarToken($length) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $codeAlphabet.= "@*#+-$";
        $max = strlen($codeAlphabet);
        
        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }
        
        return $token;
    }
}