<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService) {
        $this->menuService = $menuService;
    }

    public function index() {
        return view('admin.menu.list', [
            'title' => 'List of latest menus',
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function show(Menu $menu) {
        return view('admin.menu.edit', [
            'title' => 'Edit a menu: ' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request) {
        $successUpdate = $this->menuService->update($menu, $request);

        return redirect()->route('admin.menu.list');
    }

    public function create() {
        return view('admin.menu.add', [
            'title' => 'Add new menu',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request) {
        $result = $this->menuService->create($request);

        return redirect()->back();
    }

    public function destroy(Request $request) {
        $result = $this->menuService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Delete a menu successfully'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
