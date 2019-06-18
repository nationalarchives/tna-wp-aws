<?php
/**
 * Login notification
 *
 */

function ln_add_login_notification() {
    if ( tna_aws_is_env( $_SERVER['HTTP_HOST'] ) != 'editorial' ) {
        return '<div class="message">
        <h2>We\'ve moved!</h2>
        <p>This url has been taken out of service. Please use and bookmark:</p>
        <p><a href="https://editorial-blog.nationalarchives.gov.uk/wp-admin/">editorial-blog.nationalarchives.gov.uk/wp-admin/</a></p>
        </div>';
    }
}
