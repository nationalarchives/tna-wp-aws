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

/**
 * @param $whitelist
 * @return array|bool
 */
function dash_get_whitelist( $whitelist ) {
    if ( $whitelist ) {
        if ( is_array($whitelist) ) {
            return $whitelist;
        } else {
            $whitelist_array = array_map('trim',array_filter(explode(',', $whitelist)));
            return $whitelist_array;
        }
    }
    return false;
}

/**
 * @param $client_ip
 * @param $whitelist
 * @return bool
 */
function dash_verify_ip($client_ip, $whitelist ) {

    $ip_status = false;
    foreach ($whitelist as $value) {
        if ( $client_ip == $value ) {
            $ip_status = true;
        }
    }
    return $ip_status;
}

function dash_restrict_ip() {

    $whitelist = dash_get_whitelist( get_option('dash_ip_whitelist') );
    $client_ip = dash_get_client_ip();

    if ( $whitelist && $GLOBALS['pagenow'] != 'admin-ajax.php') {
        if ( ( is_admin() && !current_user_can('administrator') ) || $GLOBALS['pagenow'] === 'wp-login.php' ) {
            if ( dash_verify_ip( $client_ip, $whitelist ) === false ) {
                wp_redirect( home_url() );
                exit;
            }
        }
    }
}
