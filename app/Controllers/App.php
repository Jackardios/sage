<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public function logo()
    {
        return get_field('logo', 'options');
    }

    public function logoInversed()
    {
        return get_field('logo_inversed', 'options');
    }

    public function socials()
    {
        return get_field('socials', 'options');
    }

    public function emails()
    {
        return get_field('emails', 'options');
    }

    public function phones()
    {
        return get_field('phones', 'options');
    }

    public function oneOfPhone()
    {
        $phones = $this->phones();
        return (!empty($phones) ? $phones[0]['phone'] : null);
    }

    public function oneOfEmail()
    {
        $emails = $this->emails();
        return (!empty($emails) ? $emails[0]['email'] : null);
    }

    public function openingHours()
    {
        return get_field('opening_hours', 'options');
    }

    public function address()
    {
        return get_field('address', 'options');
    }

    public function addressMap()
    {
        return get_field('address_map', 'options');
    }
}
