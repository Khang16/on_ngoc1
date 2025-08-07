<?php
$VERSION = WP_DEBUG ? time() : wp_get_theme()->get('Version');;
define('THEME_VERSION', $VERSION);
// ============================== start wp_enqueue lib =====================//
// Add preconnect for Google Fonts
// function my_add_preconnects($hints, $relation_type)
// {
// 	if ('preconnect' === $relation_type) {
// 		$hints[] = [
// 			'href' => 'https://fonts.googleapis.com',
// 			'crossorigin' => 'anonymous',
// 		];
// 		$hints[] = [
// 			'href' => 'https://fonts.gstatic.com',
// 			'crossorigin' => 'anonymous',
// 		];
// 	}
// 	return $hints;
// }
// add_filter('wp_resource_hints', 'my_add_preconnects', 10, 2);

function  wp_enqueue_lib()
{
	wp_enqueue_style('fonts', get_theme_file_uri('/assets/font2/stylesheet.css'), [], THEME_VERSION);
	wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], THEME_VERSION);
	wp_enqueue_script("swiper", 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], THEME_VERSION, true);
}
add_action('wp_enqueue_scripts', 'wp_enqueue_lib', 1000);

// ============================== end wp_enqueue lib =====================//

// ============================== wp_enqueue lib =====================//
function  wp_enqueue_local()
{
	$wp_enqueue_mapping = [
		[
			'type' => 'style',
			'handle' => 'aos',
			'src' => 'https://unpkg.com/aos@2.3.1/dist/aos.css',
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => true
		],
		[
			'type' => 'script',
			'handle' => 'aos',
			'src' => 'https://unpkg.com/aos@2.3.1/dist/aos.js',
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => true
		],
		[
			'type' => 'script',
			'handle' => 'gsap-core',
			'src' => 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js',
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_front_page() || is_page_template("page-course.php") ||  is_singular('course') || is_tax('category-course')
		],
		[
			'type' => 'script',
			'handle' => 'gsap-trigger',
			'src' => 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js',
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_front_page() || is_tax('category-course')
		],
		[
			'type' => 'script',
			'handle' => 'MotionPathPlugin',
			'src' => 'https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/MotionPathPlugin.min.js',
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("page-course.php")
		],
		[
			'type' => 'style',
			'handle' => 'plyr',
			'src' => get_theme_file_uri('/assets/css/plyr.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_front_page()
		],
		[
			'type' => 'script',
			'handle' => 'plyr',
			'src' => get_theme_file_uri('/assets/js/plyr.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_front_page()
		],
		[
			'type' => 'style',
			'handle' => 'fancybox',
			'src' => get_theme_file_uri('/assets/css/fancybox.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_front_page() || is_page_template("about-us-page.php") || is_singular('course')
		],
		[
			'type' => 'script',
			'handle' => 'fancybox',
			'src' => get_theme_file_uri('/assets/js/fancybox.umd.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_front_page() || is_page_template("about-us-page.php") || is_singular('course')
		],
		[
			'type' => 'style',
			'handle' => '_reset',
			'src' => get_theme_file_uri('/assets/css/_reset.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => true
		],
		[
			'type' => 'style',
			'handle' => '_variables',
			'src' => get_theme_file_uri('/assets/css/_variables.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => true
		],
		[
			'type' => 'style',
			'handle' => 'global',
			'src' => get_theme_file_uri('/assets/css/global.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => true
		],
		[
			'type' => 'script',
			'handle' => '_utils',
			'src' => get_theme_file_uri('/assets/js/utils.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => true
		],
		[
			'type' => 'script',
			'handle' => '_custom_option',
			'src' => get_theme_file_uri('/assets/js/custom-option.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => true
		],
		[
			'type' => 'style',
			'handle' => 'header',
			'src' => get_theme_file_uri('/template-parts/header/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => !is_page_template("coming-soon-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'header',
			'src' => get_theme_file_uri('/template-parts/header/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => !is_page_template("coming-soon-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'footer',
			'src' => get_theme_file_uri('/template-parts/footer/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => !is_page_template("coming-soon-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'footer',
			'src' => get_theme_file_uri('/template-parts/footer/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => !is_page_template("coming-soon-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'front-page',
			'src' => get_theme_file_uri('/template-parts/front-page/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_front_page()
		],
		[
			'type' => 'script',
			'handle' => 'front-page',
			'src' => get_theme_file_uri('/template-parts/front-page/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_front_page()
		],
		[
			'type' => 'style',
			'handle' => 'opening-course-schedule-page',
			'src' => get_theme_file_uri('/template-parts/opening-course-schedule-page/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("opening-course-schedule-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'opening-course-schedule-page',
			'src' => get_theme_file_uri('/template-parts/opening-course-schedule-page/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("opening-course-schedule-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'coming-soon-page',
			'src' => get_theme_file_uri('/template-parts/coming-soon-page/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("coming-soon-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'coming-soon-page',
			'src' => get_theme_file_uri('/template-parts/coming-soon-page/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("coming-soon-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'contact-page',
			'src' => get_theme_file_uri('/template-parts/contact/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("contact-page.php") || is_page_template("opening-course-schedule-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'contact-page',
			'src' => get_theme_file_uri('/template-parts/contact/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("contact-page.php") || is_page_template("opening-course-schedule-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'contact-page-branches',
			'src' => get_theme_file_uri('/template-parts/contact/branches/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("contact-page.php") || is_page_template("opening-course-schedule-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'contact-page-branches',
			'src' => get_theme_file_uri('/template-parts/contact/branches/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("contact-page.php") || is_page_template("opening-course-schedule-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'blog-detail',
			'src' => get_theme_file_uri('/template-parts/blog-detail/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_singular('post')
		],
		[
			'type' => 'script',
			'handle' => 'blog-detail',
			'src' => get_theme_file_uri('/template-parts/blog-detail/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_singular('post')
		],
		[
			'type' => 'style',
			'handle' => 'blog-list',
			'src' => get_theme_file_uri('/template-parts/blog-list/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("blog-list.php")
		],
		[
			'type' => 'script',
			'handle' => 'blog-list',
			'src' => get_theme_file_uri('/template-parts/blog-list/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("blog-list.php")
		],
		[
			'type' => 'style',
			'handle' => 'page-course',
			'src' => get_theme_file_uri('/template-parts/page-course/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("page-course.php")
		],

		[
			'type' => 'script',
			'handle' => 'page-course',
			'src' => get_theme_file_uri('/template-parts/page-course/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("page-course.php")
		],
		[
			'type' => 'script',
			'handle' => 'video-luyen-nghe',
			'src' => get_theme_file_uri('/template-parts/taxonomy-video-luyen-nghe/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_tax('categories-extends', 'video-luyen-nghe')
		],
		[
			'type' => 'style',
			'handle' => 'video-luyen-nghe',
			'src' => get_theme_file_uri('/template-parts/taxonomy-video-luyen-nghe/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_tax('categories-extends', 'video-luyen-nghe')
		],
		[
			'type' => 'script',
			'handle' => 'taxonomy-categories-extends',
			'src' => get_theme_file_uri('/template-parts/taxonomy-categories-extends/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_tax('categories-extends', 'tu-vung-chuyen-nganh')
		],
		[
			'type' => 'style',
			'handle' => 'taxonomy-categories-extends',
			'src' => get_theme_file_uri('/template-parts/taxonomy-categories-extends/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_tax('categories-extends', 'tu-vung-chuyen-nganh')
		],
		[
			'type' => 'script',
			'handle' => 'single-course',
			'src' => get_theme_file_uri('/template-parts/single-course/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' =>  is_singular('course')
		],
		[
			'type' => 'style',
			'handle' => 'single-course',
			'src' => get_theme_file_uri('/template-parts/single-course/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' =>  is_singular('course')
		],
		[
			'type' => 'style',
			'handle' => 'taxonomy-categories-blog',
			'src' => get_theme_file_uri('/template-parts/taxonomy-categories-blog/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_category()
		],
		[
			'type' => 'script',
			'handle' => 'taxonomy-categories-blog',
			'src' => get_theme_file_uri('/template-parts/taxonomy-categories-blog/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_category()
		],
		[
			'type' => 'script',
			'handle' => 'custom-drawer',
			'src' => get_theme_file_uri('/assets/js/custom-drawer.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => true
		],
		[
			'type' => 'script',
			'handle' => 'leader-line',
			'src' => 'https://cdnjs.cloudflare.com/ajax/libs/leader-line/1.0.7/leader-line.min.js',
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_tax('category-course')
		],
		[
			'type' => 'style',
			'handle' => 'hsk-course',
			'src' => get_theme_file_uri('/template-parts/hsk-course/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_tax('category-course')
		],
		[
			'type' => 'script',
			'handle' => 'hsk-course',
			'src' => get_theme_file_uri('/template-parts/hsk-course/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_tax('category-course')
		],
		[
			'type' => 'style',
			'handle' => 'about-us-new-language',
			'src' => get_theme_file_uri('/template-parts/about-us/section-new-language/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("about-us-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'about-us-new-language',
			'src' => get_theme_file_uri('/template-parts/about-us/section-new-language/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("about-us-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'about-us-introduction',
			'src' => get_theme_file_uri('/template-parts/about-us/section-introduction/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("about-us-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'about-us-introduction',
			'src' => get_theme_file_uri('/template-parts/about-us/section-introduction/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("about-us-page.php")
		],
		[
			'type' => 'style',
			'handle' => 'about-us-become-a-student',
			'src' => get_theme_file_uri('/template-parts/about-us/section-become-a-student/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("about-us-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'about-us-become-a-student',
			'src' => get_theme_file_uri('/template-parts/about-us/section-become-a-student/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("about-us-page.php")
		],
		[

			'type' => 'style',
			'handle' => 'about-us-page',
			'src' => get_theme_file_uri('/template-parts/about-us/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("about-us-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'about-us-page',
			'src' => get_theme_file_uri('/template-parts/about-us/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("about-us-page.php")
		],
		[

			'type' => 'style',
			'handle' => 'extends-page',
			'src' => get_theme_file_uri('/template-parts/extends-page/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("extends-page.php")
		],
		[
			'type' => 'script',
			'handle' => 'extends-page',
			'src' => get_theme_file_uri('/template-parts/extends-page/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("extends-page.php")
		],
		[

			'type' => 'style',
			'handle' => 'search',
			'src' => get_theme_file_uri('/template-parts/search/assets/styles.css'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => false,
			'condition' => is_page_template("search.php") || is_search()
		],
		[
			'type' => 'script',
			'handle' => 'search',
			'src' => get_theme_file_uri('/template-parts/search/assets/scripts.js'),
			'deps' => [],
			'ver' => THEME_VERSION,
			'in_footer' => true,
			'condition' => is_page_template("search.php")|| is_search()
    ],
    [
      'type' => 'style',
      'handle' => 'search-results',
      'src' => get_theme_file_uri('/template-parts/try/grid-items/assets/styles.css'),
      'deps' => [],
      'ver' => THEME_VERSION,
      'in_footer' => false,
      'condition' => is_page_template("search.php") || is_search()
    ],
    [
      'type' => 'script',
      'handle' => 'search-results',
      'src' => get_theme_file_uri('/template-parts/try/grid-items/assets/scripts.js'),
      'deps' => [],
      'ver' => THEME_VERSION,
      'in_footer' => true,
      'condition' => is_page_template("search.php") || is_search()
    ],
    [
      'type' => 'style',
      'handle' => 'try',
      'src' => get_theme_file_uri('/template-parts/try/grid-items/assets/styles.css'),
      'deps' => [],
      'ver' => THEME_VERSION,
      'in_footer' => false,
      'condition' => is_tax('try') || is_post_type_archive('try') || is_tax('try-categories')
    ],
    [
      'type' => 'script',
      'handle' => 'try',
      'src' => get_theme_file_uri('/template-parts/try/grid-items/assets/scripts.js'),
      'deps' => [],
      'ver' => THEME_VERSION,
      'in_footer' => true,
      'condition' => is_tax('try') || is_post_type_archive('try') || is_tax('try-categories')
    ],
    [
      'type' => 'script',
      'handle' => 'try-grid-items',
      'src' => get_theme_file_uri('/template-parts/try/grid-items/assets/scripts.js'),
      'deps' => [],
      'ver' => THEME_VERSION,
      'in_footer' => true,
      'condition' => is_tax('try-categories') || is_post_type_archive('try')
    ]
	];

	foreach ($wp_enqueue_mapping as $wp_enqueue) {
		if (!$wp_enqueue['condition']) {
			continue;
		}
		if ($wp_enqueue['type'] == 'style') {
			wp_enqueue_style($wp_enqueue['handle'], $wp_enqueue['src'], $wp_enqueue['deps'], $wp_enqueue['ver']);
		} else {
			wp_enqueue_script($wp_enqueue['handle'], $wp_enqueue['src'], $wp_enqueue['deps'], $wp_enqueue['ver'], $wp_enqueue['in_footer']);
		}
	}
}

add_action('wp_enqueue_scripts', 'wp_enqueue_local', 1001);

add_filter('script_loader_tag', 'add_type_attribute', 10, 3);

function add_type_attribute($tag, $handle, $src)
{
	// if not your script, do nothing and return original $tag
	// if ('front-page' !== $handle && 'offcanvas' !== $handle) {
	$module_handles = ['front-page', 'page-course', 'video-luyen-nghe', 'single-course', 'taxonomy-categories-extends', 'hsk-course', 'taxonomy-categories-blog','about-us-page', 'extends-page', 'try', 'search-results'];
	if (!in_array($handle, $module_handles, true)) {
		return $tag;
	}

	// change the script tag by adding type="module" and return it.
	$tag = '<script type="module" src="' . esc_url($src) . '"></script>';
	return $tag;
}

// ============================== wp_enqueue lib =====================//