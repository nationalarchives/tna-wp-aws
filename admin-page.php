<?php
/**
 * TNA WP AWS admin page
 *
 */

function tna_aws_add_menu_item() {
    add_options_page('TNA AWS admin', 'TNA AWS', 'manage_options', 'tna-aws-admin', 'tna_aws_admin_page', null, 99);
}

function tna_aws_admin_page_settings() {
    register_setting( 'tna-aws-group', 'rd_ip_whitelist' );
}

function tna_aws_admin_page() {
    ?>
    <style>
        .tna-aws-admin input[type=text], .tna-aws-admin textarea {
            width: 100%;
            max-width: 480px;
            height: 130px;
        }
        .tna-aws-admin .dash-frame {
            border: 1px solid #ddd;
            padding: 1em;
            background-color: #fff;
            max-width: 576px;
        }
        .tna-aws-admin p {
            margin: 1em 0;
        }
    </style>
    <div class="wrap tna-aws-admin">
        <h1>TNA AWS admin</h1>
        <hr>
        <h2>Restrict Dashboard</h2>
        <h3>Whitelist</h3>
        <p>Your IP address: <strong><?php echo tna_aws_get_client_ip() ?></strong></p>
        <p>Enabling this plugin will <strong>block all IP addresses</strong> accessing the dashboard login page except for the white listed addresses below.</p>
        <form method="post" action="options.php">
            <?php settings_fields( 'tna-aws-group' ); ?>
            <?php do_settings_sections( 'tna-aws-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="rd_ip_whitelist">IP whitelist</label></th>
                    <td><textarea name="rd_ip_whitelist"><?php echo esc_attr( get_option('rd_ip_whitelist') ); ?></textarea></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        <hr>
        <h2>Search engine bots</h2>
        <p>Environment: <strong><?php
                $env = tna_aws_is_env( $_SERVER['HTTP_HOST'] );
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
    </div>
    <?php
}