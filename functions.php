<?php
/**
 * TNA Restrict Dashboard functions
 *
 */

function dash_get_client_ip() {
    //whether ip is from share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    return $ip_address;
}

function dash_get_whitelist() {

}

function dash_verify_ip( $ip, $whitelist ) {
    if ( $GLOBALS['pagenow'] === 'wp-login.php' ) {


    }
}