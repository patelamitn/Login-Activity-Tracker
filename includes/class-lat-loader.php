<?php
if (!defined('ABSPATH')) exit;

class LAT_Loader {
    public function run() {
        add_action('wp_login', [$this, 'log_successful_login'], 10, 2);
        add_action('wp_login_failed', [$this, 'log_failed_login']);
        add_action('admin_menu', [$this, 'add_admin_page']);
    }

    public function log_successful_login($user_login, $user) {
        $this->log_activity($user_login, 'success');
    }

    public function log_failed_login($username) {
        $this->log_activity($username, 'failed');
    }

    private function log_activity($username, $status) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $timestamp = current_time('mysql');
        $entry = compact('username', 'ip', 'ua', 'timestamp', 'status');
        $logs = get_option('lat_logs', []);
        array_unshift($logs, $entry);
        update_option('lat_logs', array_slice($logs, 0, 100));
    }

    public function add_admin_page() {
        add_menu_page('Login Logs', 'Login Tracker', 'manage_options', 'lat-logs', [$this, 'render_admin_page']);
    }

    public function render_admin_page() {
        $logs = get_option('lat_logs', []);
        echo '<div class="wrap"><h1>Login Activity</h1><table class="widefat"><thead><tr><th>User</th><th>IP</th><th>Time</th><th>Status</th></tr></thead><tbody>';
        foreach ($logs as $log) {
            echo '<tr><td>' . esc_html($log['username']) . '</td><td>' . esc_html($log['ip']) . '</td><td>' . esc_html($log['timestamp']) . '</td><td>' . esc_html($log['status']) . '</td></tr>';
        }
        echo '</tbody></table></div>';
    }
}
