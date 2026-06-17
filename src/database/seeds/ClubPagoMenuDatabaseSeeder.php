<?php

namespace Corals\Modules\Payment\ClubPago\database\seeds;

use Corals\Menu\Models\Menu;
use Illuminate\Database\Seeder;

class ClubPagoMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_id = Menu::where('key', 'payment')->first();
        if (!is_null($menu_id)) {
            // seed children menu
            \DB::table('menus')->insert([
                    [
                        'parent_id' => $menu_id,
                        'key' => 'clubpago',
                        'url' => config('clubpago.models.clubpago_reference.resource_url'),
                        'active_menu_url' => config('clubpago.models.clubpago_reference.resource_url') . '*',
                        'name' => 'Referencias Club Pago',
                        'description' => 'Referencias Club Pago List Menu Item',
                        'icon' => 'fa fa-file-pdf-o',
                        'target' => null,
                        'roles' => '["1","2","3"]',
                        'order' => 10
                    ],
                ]
            );
        } else {
            \DB::table('menus')->insert([
                    [
                        'parent_id' => 1,
                        'key' => 'clubpago',
                        'url' => config('clubpago.models.clubpago_reference.resource_url'),
                        'active_menu_url' => config('clubpago.models.clubpago_reference.resource_url') . '*',
                        'name' => 'Referencias Club Pago',
                        'description' => 'Referencias Club Pago List Menu Item',
                        'icon' => 'fa fa-file-pdf-o',
                        'target' => null,
                        'roles' => '["1","2","3"]',
                        'order' => 10
                    ],
                ]
            );

        }
    }
}
