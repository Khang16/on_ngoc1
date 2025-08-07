<?php

/**
 * Allow changing or removing the Breadcrumb items
 *
 * @param array       $crumbs The crumbs array.
 * @param Breadcrumbs $this   Current breadcrumb object.
 */
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
    if (is_singular('course')) {
        $crumbs = get_course_crumbs($crumbs);
    }
    if (is_tax('categories-extends')) {
        $crumbs = get_extends_crumbs($crumbs);
    }
    if (is_tax('category-course')) {
        $crumbs = get_course_category_crumbs($crumbs);
    }

    return $crumbs;
}, 10, 2);


function get_course_crumbs($crumbs)
{
    $crumbs = [
        [
            0 => 'Trang chủ',
            1 => home_url(),
            'hide_in_schema' => '',
        ],
        [
            0 => 'Khóa học',
            1 => home_url('/khoa-hoc'),
            'hide_in_schema' => '',
        ],
    ];
    $terms = get_the_terms(get_the_ID(), 'category-course');
    if ($terms) {
        $crumbs[] = [
            0 => $terms[0]->name,
            1 => get_term_link($terms[0]),
            'hide_in_schema' => '',
        ];
    }
    $crumbs[] = [
        0 => get_the_title(),
        1 => get_the_permalink(),
        'hide_in_schema' => '',
    ];
    return $crumbs;
}

function get_extends_crumbs($crumbs)
{
    $crumbs = [
        [
            0 => 'Trang chủ',
            1 => home_url(),
            'hide_in_schema' => '',
        ],
        [
            0 => 'Mở rộng',
            1 => home_url('/mo-rong'),
            'hide_in_schema' => '',
        ],
        [
            0 => get_queried_object()->name,
            1 => get_term_link(get_queried_object()),
            'hide_in_schema' => '',
        ],
    ];
    return $crumbs;
}

function get_course_category_crumbs($crumbs)
{
    $crumbs = [
        [
            0 => 'Trang chủ',
            1 => home_url(),
            'hide_in_schema' => '',
        ],
        [
            0 => 'Khóa học',
            1 => home_url('/khoa-hoc'),
            'hide_in_schema' => '',
        ],
        [
            0 => get_queried_object()->name,
            1 => get_term_link(get_queried_object()),
            'hide_in_schema' => '',
        ],
    ];
    return $crumbs;
}