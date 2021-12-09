<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Entity;
use App\Models\UserType;
use App\Models\Role;
use App\Models\Site;
use App\Models\Area;
use App\Models\Kiosk;
use App\Models\Setting;
use App\Models\Department;
use App\Models\ScanDataTypes;
use App\Models\InputMethods;
use App\Models\Visit;
use App\Models\Scan;
use App\Helpers\SettingsHelper;
use App\Helpers\ScanDataTypesHelper;
use App\Helpers\InputMethodsHelper;
use App\Models\Journey;
use App\Models\LamasatechSerial;
use Faker as Faker;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {

        $faker = Faker\Factory::create();

        $lamastechSerial = [];
        $count = 0;
        for ($i = 709113591916290001; $i < 709113591916290899; $i++) {
            $lamastechSerial[$count]['id'] = $i;
            $count++;
        }
        LamasatechSerial::insert($lamastechSerial);
        // add settings
        $settings = [];
        $count = 0;
        foreach (SettingsHelper::SETTINGS as $setting) {
            if ($setting['id'] != 73 && $setting['id'] != 74 && $setting['id'] != 75 ) {
                $settings [$count] = $setting;
            }
            $count++;
        }

        Setting::insert($settings);
        //create the default entity
        $entityId = $faker->uuid;
        $adminId = $faker->uuid;
        $entity = Entity::create([
                    'id' => $entityId,
                    'name' => 'Default compony ',
                    'subdomain' => 'subdomain.visipoint.co',
                    'package' => 'Cloud',
                    'owner_id' => $adminId,
        ]);
        $settings = Setting::where('category', Setting::TYPE['ENTITY'])->get();
        foreach ($settings as $setting) {
            $entity->setting()->attach($setting->id, ['value' => $setting->default_value]);
        }
        $s3 = \Storage::disk('s3');
        $s3->makeDirectory('/profiles/' . $entityId);
        $s3->makeDirectory('/scans/' . $entityId);
        //create the default UserType
        $userTypes = [];
        foreach (UserType::DEFALUT_USER_TYPE as $userType) {
            $name = $userType;
            $userType = UserType::create([
                        'id' => $entityId . '-' . $userType,
                        'entity_id' => $entityId,
                        'name' => $userType,
                        'created_at' => now()
            ]);
        }
//
//        // create defulate role
//        $roles = [];
//        foreach (Role::DEFALUT_ROLE as $role) {
//            $roles [] = [
//                'id' => $faker->uuid,
//                'entity_id' => $entityId,
//                'name' => $role,
//            ];
//        }
//        Role::insert($roles);
//
        //create the journey site
        $journeyId = $faker->uuid;
        Journey::create([
            'id' => $journeyId,
            'description' => $faker->text,
            'name' => 'Default Journey',
            'entity_id' => $entityId,
        ]);
        //create the default site
        $siteId = $faker->uuid;
        $site = Site::create([
                    'id' => $siteId,
                    'name' => 'Default Site',
                    'entity_id' => $entityId,
                    'is_default' => 1,
        ]);

        //create the default area
        $areaId = $faker->uuid;
        $area = Area::create([
                    'id' => $areaId,
                    'name' => Area::DEFALUT_AREA,
                    'site_id' => $siteId,
                    'journey_id' => $journeyId,
                    'is_default' => 1,
        ]);
        // area 2 from defulte 
        $area2Id = $faker->uuid;
        $area2 = Area::create([
                    'id' => $area2Id,
                    'name' => "HR Area",
                    'site_id' => $siteId,
                    'parent_id' => $areaId,
                    'journey_id' => $journeyId,
                    'is_default' => 1,
        ]);

        //create the default site
        $site2Id = $faker->uuid;
        $site2 = Site::create([
                    'id' => $site2Id,
                    'name' => ' lamasatech Site',
                    'entity_id' => $entityId,
                    'is_default' => 1,
        ]);
        //create the default area
        $area3Id = $faker->uuid;
        $area3 = Area::create([
                    'id' => $area3Id,
                    'name' => "IT Area",
                    'site_id' => $site2Id,
                    'journey_id' => $journeyId,
                    'is_default' => 1,
        ]);
        // kiosk in area defulte
        $kioskId = $faker->uuid;
        $settings = Setting::where('category', Setting::TYPE['KIOSK'])->get();
        $kiosk1 = Kiosk::create([
                    'id' => $kioskId,
                    'name' => "k1",
                    'area_id' => $areaId,
                    'entity_id' => $entityId,
                    'android_serial' => "123456789123456788",
                    'lamasatech_serial' => "709113591916290001",
                    'mac_address' => "8CFCA006A08A",
                    'date_of_purchase' => now(),
                    'purchased_from' => "Lamastech",
        ]);
        // kiosk in area 2
        $kiosk2Id = $faker->uuid;
        $kiosk2 = Kiosk::create([
                    'id' => $kiosk2Id,
                    'name' => "k2",
                    'area_id' => $area2Id,
                    'entity_id' => $entityId,
                    'android_serial' => "123456789123456788",
                    'lamasatech_serial' => "709113591916290002",
                    'mac_address' => "8CFCA006A07E",
                    'date_of_purchase' => now(),
                    'purchased_from' => "Lamastech",
        ]);
        foreach ($settings as $setting) {
            $kiosk1->setting()->attach($setting->id, ['value' => $setting->default_value]);
            $kiosk2->setting()->attach($setting->id, ['value' => $setting->default_value]);
            $site->massKiosksetting()->attach($setting->id, ['value' => $setting->default_value]);
            $site2->massKiosksetting()->attach($setting->id, ['value' => $setting->default_value]);
            $area->massKiosksetting()->attach($setting->id, ['value' => $setting->default_value]);
            $area2->massKiosksetting()->attach($setting->id, ['value' => $setting->default_value]);
            $area3->massKiosksetting()->attach($setting->id, ['value' => $setting->default_value]);
        }
//
//        // create defulate Department
//        $defulatDepartment = [];
//        foreach (Department::DEFALUT_DEPARTMENT as $department) {
//            $defulatDepartment [] = [
//                'id' => $faker->uuid,
//                'entity_id' => $entityId,
//                'name' => $department,
//                'description' => $department,
//            ];
//        }
//        Department::insert($defulatDepartment);
//
        //create default user
        $user = User::create([]);
        $user->attachEntityUser($entity, ['id' => $adminId,
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'user_type_id' => UserType::inRandomOrder()->first()->id,
            'user_user_id' => $faker->unique()->randomNumber(),
            'rfid_number' => $faker->unique()->randomNumber(),
            'phone' => $faker->phoneNumber,
            'email' => 'admin@visipoint.com',
            'password' => '123456789',
            'is_active' => 1,
            'system_user' => 1,
            'created_at' => now(),]);
        $user1 = User::create([]);
        $user1->attachEntityUser($entity, ['id' => $faker->uuid,
            'first_name' => 'default',
            'last_name' => 'user',
            'user_user_id' => $faker->unique()->randomNumber(),
            'rfid_number' => $faker->unique()->randomNumber(),
            'email' => 'lt_techteam@visipoint.com',
            'password' => 'o]%(L,g#>N9/&%(',
            'is_active' => 1,
            'system_user' => 1,
            'created_at' => now(),]);
        // create 50 user 
        for ($i = 0; $i < 50; $i++) {
            $user = User::create([]);
            $user->attachEntityUser($entity, ['id' => $faker->uuid,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'user_type_id' => UserType::inRandomOrder()->first()->id,
                'user_user_id' => $faker->unique()->randomNumber(),
                'rfid_number' => $faker->unique()->randomNumber(),
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'is_active' => 1,
                'created_at' => now(),]);
        }
        // create Scan Data Type 
        $scanDataTypes = [];
        $count = 0;
        foreach (ScanDataTypesHelper::ScanDataTypes as $scanDataType) {
            $scanDataTypes [$count] = $scanDataType;
            $count++;
        }
        ScanDataTypes::insert($scanDataTypes);
        // create input Methods 
        $inputMethods = [];
        $count = 0;
        foreach (InputMethodsHelper::InputMethods as $inputMethod) {
            $inputMethods [$count] = $inputMethod;
            $count++;
        }
        InputMethods::insert($inputMethods);
        // create 10 visite 
        for ($i = 0; $i < 10; $i++) {
            $visitId = $faker->uuid;
            $scanDataTypeId = ScanDataTypes::firstWhere('name', ScanDataTypes::STATUS['CHECKED_IN'])->id;
            Visit::create([
                'id' => $visitId,
                'user_id' => User::inRandomOrder()->first()->id,
                'entity_id' => $entityId,
                'scan_data_type_id' => $scanDataTypeId,
                'date' => now(),
                'signed_in' => now(),
                'created_at' => now(),
            ]);
            $kiosk = Kiosk::inRandomOrder()->first();
            Scan::create([
                'id' => $faker->uuid,
                'temperature' => 37.5,
                'temperature_type' => $kiosk->settingTemperature[0]->pivot->value ?? 'c',
                'has_mask' => true,
                'kiosk_id' => $kiosk->id,
                'area_id' => $kiosk->area->id,
                'visit_id' => $visitId,
                'data_type_id' => $scanDataTypeId,
                'input_methods_id' => InputMethods::inRandomOrder()->first()->id,
                'created_at' => now(),
            ]);
        }
    }

}
