<?php
/**
 * Plugin Name:       Php Version Fay
 * Plugin URI:        https://wordpress.org/plugins/fay-chat/
 * Description:       Php Version Fay is a simple yet powerful WordPress plugin that displays important information about your PHP, database and server on the WordPress Dashboard.
 * Version:           1.10.3
 * Requires at least: 4.6
 * Requires PHP:      5.0.0
 * Author:            Md. Fayjur Rahman
 * Author URI:        https://fayjur.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       php-version-fay
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( 'You cannot jump here!!' );
}


add_action('wp_dashboard_setup', 'php_vr_fay_custom_dashboard_widgets');

function php_vr_fay_custom_dashboard_widgets() {
    wp_add_dashboard_widget('php-version-fay', 'PHP & Server Information', 'php_vr_fay_custom_dashboard_help', 'high');
}

function php_vr_fay_custom_dashboard_help() {
    if(is_admin()){
        $php_version_fay = esc_html( "Current PHP version: ".phpversion());
        echo "<p>".$php_version_fay."</p><hr>";

        $php_vr_fay = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $php_vr_fay_database = mysqli_get_server_info($php_vr_fay);
//       MariaDB or MySQL database check
        if(strpos($php_vr_fay_database, "mariadb") !== false || strpos($php_vr_fay_database, "MariaDB") !== false){
            $db_version_fay = esc_html("MariaDB Version : ".$php_vr_fay_database);
        }
        else{
            $db_version_fay =esc_html("MySQL Version : ".$php_vr_fay_database);
        }
        echo "<p>".$db_version_fay."</p><hr>";

        $db_upload_max_filesize_fay = esc_html("upload_max_filesize: " . ini_get("upload_max_filesize"));
        echo "<p>".$db_upload_max_filesize_fay."</p><hr>";

        $db_post_max_size_fay = esc_html("post_max_size: " . ini_get("post_max_size"));
        echo "<p>".$db_post_max_size_fay."</p><hr>";

        $db_max_execution_time_fay = esc_html("max_execution_time: " . ini_get("max_execution_time"));
        echo "<p>".$db_max_execution_time_fay."</p><hr>";

        $db_SERVER_SOFTWARE_fay = esc_html("SERVER_SOFTWARE: ".$_SERVER["SERVER_SOFTWARE"]);
        echo "<p>".$db_SERVER_SOFTWARE_fay."</p><hr>";

        $db_DOCUMENT_ROOT_fay = esc_html("DOCUMENT_ROOT: ".$_SERVER["DOCUMENT_ROOT"]);
        echo "<p>".$db_DOCUMENT_ROOT_fay."</p><hr>";
    }
    else{
        $not_admin_php_version_fay = esc_html("Only admin can access the server info.");
        _e("<p>".$not_admin_php_version_fay."<p>", 'php-version-fay');
    }

    $free_support_php_vr_fay_1 = esc_html("For free support,");
    $free_support_php_vr_fay_2 = esc_html("Please send me an email to fayjur500@gmail.com");
    _e("<p>".$free_support_php_vr_fay_1."<br>".$free_support_php_vr_fay_2."</p>", 'php-version-fay');

}