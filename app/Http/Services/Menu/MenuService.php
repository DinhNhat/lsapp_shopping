<?php
namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MenuService
{
    public function getAll() {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function show()
    {
        return Menu::select('name', 'id')
            ->where('parent_id', 0)
            ->orderbyDesc('id')
            ->get();
    }

    public function getParent() {
        return Menu::where('parent_id', 0)->get();
    }

    public function create($request) {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (string) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
             ]);

            Session::flash('success', 'Create a menu successfully');

        } catch(\Exception $error) {
            Session::flash('error', $error->getMessage());
            return false;
        }

        return true;
    }

    public function update($menu, $request) {
//        dd($request->all());
        if ($request->input('parent_id') !== $menu->id) {
            $menu->parent_id = (int) $request->input('parent_id');
        }

        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (int) $request->input('active');

//        $menu->fill($request->input());
        if (!$menu->save()) {
            return false;
        }

        Session::flash('success', 'Update the menu successfully');
        return true;
    }

    public function destroy($request) {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();

        if($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }
}
