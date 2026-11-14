<?php
// Only the regression suite's loopback PHP server may use this router.
if (PHP_SAPI !== 'cli-server' || ($_SERVER['REMOTE_ADDR'] ?? '') !== '127.0.0.1' ||
    !getenv('WPS_SYNC_TEST_CONFIG')) {
    http_response_code(404);
    exit;
}
$config = json_decode(file_get_contents(getenv('WPS_SYNC_TEST_CONFIG')), true);
foreach ($config as $name => $value) {
    define($name, $value);
}
$table_prefix = 'wp_';
$_SERVER['HTTP_HOST'] = 'sync-test.invalid';
require ABSPATH . 'wp-settings.php';
add_filter('pre_http_request', function () {
    return new WP_Error('test_network_blocked', 'No outgoing HTTP in the test receiver');
});
add_filter('pre_wp_mail', '__return_true');
wp_set_current_user(1);
register_post_type('gallery', array('public' => true, 'supports' => array('title', 'thumbnail')));
add_theme_support('post-thumbnails');
require dirname(__DIR__, 2) . '/wp-sync-sites.php';
wps_sync_init();

$request = new WP_REST_Request('POST', '/sync/v1/media');
$request->set_header('Content-Type', $_SERVER['CONTENT_TYPE'] ?? '');
$request->set_header('Authorization', $_SERVER['HTTP_AUTHORIZATION'] ?? '');
$request->set_body(file_get_contents('php://input'));
$request->set_body_params(wp_unslash($_POST));
$request->set_file_params($_FILES);
$response = rest_do_request($request);
http_response_code($response->get_status());
header('Content-Type: application/json');
echo wp_json_encode($response->get_data());
