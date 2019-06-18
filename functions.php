<?php
/**
 * TNA WP AWS global functions
 *
 */

function tna_aws_get_client_ip() {
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

function tna_aws_is_env( $url ) {

    if ( substr( $url, 0, 4 ) === "dev-" ) {

        return 'dev';
    }
    if ( substr( $url, 0, 5 ) === "test-" ) {

        return 'test';
    }
    if ( substr( $url, 0, 10 ) === "editorial-" ) {

        return 'editorial';
    }
    if ( substr( $url, 0, 9 ) === "localhost" ) {

        return 'localhost';
    }

    return 'live';
}

