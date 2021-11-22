<?php

namespace App\Http\Controllers;

use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(SliderService $slider,
                                MenuService $menu) {
        $this->slider = $slider;
        $this->menu = $menu;
//        $this->product = $product;
    }

    public function index() {
        return view('home', [
            'title' => 'Shop Electronics',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
//            'products' => $this->product->get()
        ]);
    }
}
