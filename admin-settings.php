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
        .restrict-dashboard-admin .dash-frame {
            border: 1px solid #999;
            padding: 1em;
            background-color: #fff;
            max-width: 576px;
        }
        .restrict-dashboard-admin p {
            margin: 1em 0;
        }
        .submit .button {
            margin-right: 0.5em;
        }
    </style>
    <div class="wrap restrict-dashboard-admin">
        <h1>Restrict Dashboard</h1>
        <h2>Whitelist</h2>
        <p>Your IP address: <strong><?php echo dash_get_client_ip() ?></strong></p>
        <p>Enabling this plugin will <strong>block all IP addresses</strong> accessing the dashboard login page except for the white listed addresses below.</p>
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
            <h2>Search engine bots</h2>
            <p>Environment: <strong><?php
                    $env = dash_is_env( $_SERVER['HTTP_HOST'] );
                    echo $env;
                    ?></strong></p>
            <h3>robots.txt</h3>
            <p class="dash-frame">
                <?php
                if ( file_exists(ABSPATH.'robots.txt') ) {
                    $file = file_get_contents(ABSPATH.'robots.txt');
                    echo nl2br($file);
                } else {
                    echo 'No robots.txt file found';
                }
                ?>
            </p>
            <p class="submit">
            <?php if ( $env != 'live' ) {
                submit_button( 'Discourage bots', 'primary', 'rd-submit', false );
            }
            submit_button( 'Reset robots.txt', 'secondary', 'rd-set-submit', false );
            submit_button( 'Delete robots.txt', 'secondary', 'rd-del-submit', false );
            ?>
            </p>
        </form>
    </div>
    <?php
}