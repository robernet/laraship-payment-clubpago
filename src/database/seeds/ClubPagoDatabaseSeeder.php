<?php

namespace Corals\Modules\Payment\ClubPago\database\seeds;

use Corals\Menu\Models\Menu;
use Corals\Settings\Models\Setting;
use Corals\User\Models\Permission;
use Illuminate\Database\Seeder;
use \Spatie\MediaLibrary\Models\Media;

class ClubPagoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClubPagoPermissionsDatabaseSeeder::class);
        $this->call(ClubPagoMenuDatabaseSeeder::class);
        $this->call(ClubPagoSettingsDatabaseSeeder::class);
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'ClubPago::%')->delete();

        Menu::where('key', 'clubpago')
            ->orWhere('active_menu_url', 'like', 'clubpago%')
            ->orWhere('url', 'like', 'clubpago%')
            ->delete();

        Setting::where('category', 'ClubPago')->delete();
    }
}
