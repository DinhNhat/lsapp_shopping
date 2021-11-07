<?php


namespace App\Helpers;


class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '') {
        $html = '';

        foreach($menus as $key => $menu) {
            if ($menu->parent_id === $parent_id) {
                $requestUrl = route('admin.menu.destroy');
                $updateUrl = route('admin.menu.edit', ['menu' => $menu]);
                $activeHtml = self::active($menu->active);
                $html .= <<<EOT
                        <tr>
                        <td>$menu->id</td>
                        <td>$char$menu->name</td>
                        <td>$activeHtml</td>
                        <td>$menu->updated_at</td>
                        <td>
                            <a href=$updateUrl class="btn btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" data-menu-index=$menu->id class="btn btn-danger remove-menu" onclick="removeRow($menu->id, '$requestUrl')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                EOT;

//                $html .= '
//                    <tr>
//                        <td>' . $menu->id . '</td>
//                        <td>' . $char . $menu->name . '</td>
//                        <td>' . self::active($menu->active) . '</td>
//                        <td>' . $menu->updated_at . '</td>
//                        <td>
//                            <a href="'. route('admin.menu.edit', ['menu' => $menu]) .'" class="btn btn-info">
//                                <i class="fas fa-edit"></i>
//                            </a>
//                            <a href="#" data-menu-index="'. $menu->id .'" class="btn btn-danger remove-menu" onclick="removeRow('. $menu->id .', '. $requestUrl .')">
//                                <i class="fas fa-trash"></i>
//                            </a>
//                        </td>
//                    </tr>
//                ';

                unset($menus[$key]);
                $html .= self::menu($menus, $menu->id, $char . '|--');
            }
        }

        return $html;
    }

    public static function active($active = 0) : string {
        return $active === 0 ? '<span class="btn btn-danger btn-xs">NO</span>' : '<span class="btn btn-success btn-xs">YES</span>';
    }
}
