<?php
/**
 * TNA Restrict Dashboard admin settings page
 *
 */

function dash_add_menu_item() {
    add_options_page('Restrict Dashboard settings', 'Restrict Dashboard', 'manage_options', 'restrict-dashboard-admin', 'restrict_dashboard_settings_page', null, 99);
}

function dash_admin_page_settings() {
    register_setting( 'restrict-dashboard-group', 'dash_ip_whitelist' );
}

function restrict_dashboard_settings_page() {
    ?>
    <style>
        .restrict-dashboard-admin input[type=text], .restrict-dashboard-admin textarea {
            width: 100%;
            max-width: 480px;
        }
    </style>
    <div class="wrap restrict-dashboard-admin">
        <h1>Restrict Dashboard</h1>
        <p>Your current IP address: <?php echo dash_get_client_ip() ?></p>
        <form method="post" action="options.php">
            <?php settings_fields( 'restrict-dashboard-group' ); ?>
            <?php do_settings_sections( 'restrict-dashboard-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="dash_ip_whitelist">IP whitelist</label></th>
                    <td><textarea name="dash_ip_whitelist"><?php echo esc_attr( get_option('dash_ip_whitelist') ); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}