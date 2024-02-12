<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BannerParallax extends Component
{
    public $page;

    public $image_page;

    public function getPageBasedUrl()
    {
        $blogController = app('App\Http\Livewire\Blog')->getUrl();
        $aboutController = app('App\Http\Livewire\About')->getUrl();
        $contactController = app('App\Http\Livewire\Contact')->getUrl();
        $termController = app('App\Http\Livewire\Term')->getUrl();
        $adminDashboardController = app('App\Http\Livewire\AdminDashboard')->getUrl();

        if ($blogController == 'http://localhost:8000/blog') {
            return $this->page = 'Blog';
        } elseif ($aboutController == 'http://localhost:8000/about') {
            return $this->page = 'About';
        } elseif ($contactController == 'http://localhost:8000/contact') {
            return $this->page = 'Contact';
        } elseif ($termController == 'http://localhost:8000/term') {
            return $this->page = 'Term & Condition';
        } elseif ($adminDashboardController == 'http://localhost:8000/admin-dashboard') {
            return $this->page = 'Admin Dashboard';
        }
    }

    public function getImageBasedPage()
    {
        $blogController = app('App\Http\Livewire\Blog')->getUrl();
        $aboutController = app('App\Http\Livewire\About')->getUrl();
        $contactController = app('App\Http\Livewire\Contact')->getUrl();
        $termController = app('App\Http\Livewire\Term')->getUrl();
        $adminDashboardController = app('App\Http\Livewire\AdminDashboard')->getUrl();

        if ($blogController == 'http://localhost:8000/blog') {
            return $this->image_page = '/assets/parallax-img.png';
        } elseif ($aboutController == 'http://localhost:8000/about') {
            return $this->image_page = '/assets/landing-banner.jpeg';
        } elseif ($contactController == 'http://localhost:8000/contact') {
            return $this->image_page = '/assets/landing-banner-2.png';
        } elseif ($termController == 'http://localhost:8000/term') {
            return $this->image_page = '/assets/about-parallax.png';
        } elseif ($adminDashboardController == 'http://localhost:8000/admin-dashboard') {
            return $this->image_page = 'assets/landing-banner-2.png';
        }
    }

    public function render()
    {
        return view('components.banner-parallax', [
            'title_page' => $this->getPageBasedUrl(),
            'page_image' => $this->getImageBasedPage(),
        ]);
    }
}
