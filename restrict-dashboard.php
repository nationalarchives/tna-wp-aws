<?php
/**
 * Restrict Dashboard
 *
 */

/**
 * @param $whitelist
 * @return array|bool
 */
function rd_get_whitelist( $whitelist ) {
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
function rd_verify_ip($client_ip, $whitelist ) {

    $ip_status = false;
    foreach ($whitelist as $value) {
        if ( $client_ip == $value ) {
            $ip_status = true;
        }
    }
    return $ip_status;
}

/**
 * Restricts all IP addresses excluding whitelist
 *
 */
function rd_restrict_dashboard() {

    $whitelist = rd_get_whitelist( get_option('rd_ip_whitelist') );
    $client_ip = tna_aws_get_client_ip();

    if ( $whitelist && $GLOBALS['pagenow'] != 'admin-ajax.php') {
        if ( ( is_admin() && !current_user_can('administrator') ) || $GLOBALS['pagenow'] === 'wp-login.php' ) {
            if ( rd_verify_ip( $client_ip, $whitelist ) === false ) {
                wp_redirect( home_url() );
                exit;
            }
        }
    }
}
