<?php

use Detection\Exception\MobileDetectException;
use Detection\MobileDetectStandalone;

require_once 'Mobile-Detect/standalone/autoloader.php';
require_once 'Mobile-Detect/src/MobileDetectStandalone.php';
$detection = new MobileDetectStandalone();

define('IS_MOBILE', $detection->isMobile() && !$detection->isTablet());

function get_full_content($post_id)
{
    $post = get_post($post_id);
    if (!$post) return '';
    return apply_filters('the_content', $post->post_content);
}

function isMobileDevice()
{
    if (!isset($_SERVER['HTTP_USER_AGENT'])) {
        return true;
    }
    $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

    // Nhận diện nhanh một số tablet phổ biến
    if (strpos($useragent, 'ipad') !== false || strpos($useragent, 'tablet') !== false || strpos($useragent, 'kindle') !== false || strpos($useragent, 'silk') !== false || strpos($useragent, 'playbook') !== false) {
        return true;
    }

    return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent)
        || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
}

add_action('template_redirect', 'redirect_to_coming_soon_301');

function redirect_to_coming_soon_301()
{
    // Các path tĩnh được phép truy cập
    $allowed_paths = [
        '/',
        '/lich-khai-giang',
        '/coming-soon',
    ];

    // Lấy path từ URL
    $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $normalized_path = rtrim($current_path, '/');
    $normalized_path = $normalized_path === '' ? '/' : $normalized_path;

    // Điều kiện được phép truy cập
    $is_allowed = in_array($normalized_path, $allowed_paths);

    // Nếu là trang chi tiết bài viết thì cho phép
    if (is_single()) {
        $is_allowed = true;
    }

    // Không phải admin và không có quyền edit → redirect
    if (!$is_allowed && !is_admin() && !current_user_can('edit_posts')) {
        wp_redirect(home_url('/coming-soon/'), 301);
        exit;
    }
}
add_action('template_redirect', 'redirect_to_coming_soon_301');

add_action('save_post_youtube-video', 'update_youtube_video_duration', 10, 3);
add_action('wp_insert_post', 'update_youtube_video_duration', 10, 3);
function update_youtube_video_duration($post_ID, $post, $update)
{
    // Tránh gọi khi autosave hoặc revision
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ($post->post_type !== 'youtube-video') return;

    // Lấy link từ custom field
    $youtube_link = get_field('youtube_video_link', $post_ID);
    if (!$youtube_link) return;

    // Tách video ID
    parse_str(parse_url($youtube_link, PHP_URL_QUERY), $query_vars);
    $video_id = $query_vars['v'] ?? '';

    if (!$video_id) return;

    // Gọi API YouTube
    $api_key = 'AIzaSyB79e9AiZMQcono3rXElnPNPq1ocxJJBGI'; // TODO: thay bằng API Key thật
    $api_url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id={$video_id}&key={$api_key}";

    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) return;

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (empty($data['items'][0]['contentDetails']['duration'])) return;

    $duration_iso = $data['items'][0]['contentDetails']['duration'];
    $duration_seconds = youtube_duration_format($duration_iso);

    // Chỉ cập nhật nếu giá trị mới khác giá trị cũ
    $old_duration = get_post_meta($post_ID, '_youtube_video_duration', true);
    if ($old_duration !== $duration_seconds) {
        update_post_meta($post_ID, '_youtube_video_duration', $duration_seconds);
    }
}

function youtube_duration_format($duration)
{
    try {
        $interval = new DateInterval($duration);

        $hours = $interval->h + ($interval->d * 24);
        $minutes = $interval->i;
        $seconds = $interval->s;

        if ($hours > 0) {
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%02d:%02d', $minutes, $seconds);
        }
    } catch (Exception $e) {
        return '00:00';
    }
}


function ration_add_featured_image_html($html)
{
    $screen = get_current_screen();

    $post = [
        'post' => '<p>Khuyến khích sử dụng ảnh tỉ lệ (424x212).</p>',
        'course' => '<p>Khuyến khích sử dụng ảnh tỉ lệ (424x212).</p>'
    ];

    $page = [
        // page ID => thông báo
    ];

    $post_type = get_post_type();

    if (array_key_exists($post_type, $post)) {
        $html .= $post[$post_type];
    } elseif (is_admin() && ($screen->id == 'page')) {
        global $post;
        $id = $post->ID;
        if (array_key_exists($id, $page)) {
            $html .= $page[$id];
        }
    }

    return $html;
}
add_filter('admin_post_thumbnail_html', 'ration_add_featured_image_html');

