<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserType;
use App\Models\Visit;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\CronJobs;

class PrivacyManagerCron extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'privacyManager:cron {--entityId=}{--userTypes=*}{--beforeDate=}{--type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        Log::info("Cron is working fine!");
        Log::info("----------privacyManager--------");
        $entityId = !empty($this->option('entityId')) ? $this->option('entityId') : null;
        Log::info(['entityId' => $entityId]);
        $userTypes = !empty($this->option('userTypes')) ? $this->option('userTypes') : null;
        Log::info(['userTypes' => $userTypes]);
        $type = !empty($this->option('type')) ? $this->option('type') : null;
        Log::info(['type' => $type]);
        $beforeDate = !empty($this->option('beforeDate')) ? date('Y-m-d', strtotime($this->option('beforeDate'))) : null;
        Log::info(['beforeDate' => $beforeDate]);
        $entities = !empty($entityId) ? Entity::where('id', $entityId)->get() : Entity::all();
        foreach ($entities as $entity) {
            $cronJob = CronJobs::firstOrCreate(array('name' => 'privacyManager', 'entity_id' => $entity->id));
            Log::info(['entity' => ($entity) ? $entity->id : null]);
            if ($entity->privacyManager[0]->pivot->value) {
                Log::info(['entityprivacyManager' => ($entity) ? $entity->privacyManager[0]->pivot->value : null]);
                $userTypesObjects = !empty($userTypes) ? UserType::whereIn('id', $userTypes)->orWhereIn('parent_id', $userTypes)->get() : UserType::where('entity_id', $entity->id)->get();
                foreach ($userTypesObjects as $userType) {
                    Log::info([$userType->name => $userType->id]);
                    if ($userType->privacyManagerSettings) {
                        foreach ($userType->privacyManagerSettings as $setting) {
                            Log::info([$setting->name => $setting->pivot->value]);
                            CronJobs::find($cronJob->id)->update(['Last_run' => now(), 'status' => CronJobs::STATUS['PROCESSING']]);
                            try {
                                if ($type != 'both' || $type == 'cron' ||($type == 'both' && !empty($beforeDate))) {
                                    if ($setting->pivot->value != 0) {
                                        if ($type == 'scan' && $setting->name == 'SCAN_RETENTION' && empty($beforeDate)) {
                                            $date = Carbon::now()->subDays($setting->pivot->value);
                                            Log::info(['Scandate' => $date]);
                                            Visit::join('users', 'users.id', '=', 'visits.user_id')
                                                    ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                                                    ->where('visits.entity_id', $entity->id)
                                                    ->where('user_types.id', $userType->id)
                                                    ->whereDate('visits.date', '<=', $date)
                                                    ->delete();
                                        }
                                        if ($type == 'data' && $setting->name == 'data_retention' && empty($beforeDate)) {
                                            $date = Carbon::now()->subDays($setting->pivot->value);
                                            Log::info(['Userdate' => $date]);
                                            DB::table('entity_user')->join('users', 'users.id', '=', 'entity_user.user_id')
                                                    ->where(['users.system_user' => 0, 'entity_user.entity_id' => $entity->id, 'users.user_type_id' => $userType->id])
                                                    ->whereDate('users.created_at', '<=', $date)
                                                    ->update(array('entity_user.deleted_at' => now()));
                                        }
                                    }
                                    if ($type == 'both' && !empty($beforeDate)) {
                                        if ($setting->name == 'SCAN_RETENTION') {
                                            Visit::join('users', 'users.id', '=', 'visits.user_id')
                                                    ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                                                    ->where('visits.entity_id', $entity->id)
                                                    ->where('user_types.id', $userType->id)
                                                    ->whereDate('visits.date', '<', $beforeDate)
                                                    ->delete();
                                        }
                                        if ($setting->name == 'data_retention') {
                                            DB::table('entity_user')->join('users', 'users.id', '=', 'entity_user.user_id')
                                                    ->where(['users.system_user' => 0, 'entity_user.entity_id' => $entity->id, 'users.user_type_id' => $userType->id])
                                                    ->whereDate('users.created_at', '<', $beforeDate)
                                                    ->update(array('entity_user.deleted_at' => now()));
                                        }
                                    }
                                } else {
                                    if ($setting->name == 'SCAN_RETENTION') {
                                        Visit::join('users', 'users.id', '=', 'visits.user_id')
                                                ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                                                ->where('visits.entity_id', $entity->id)
                                                ->where('user_types.id', $userType->id)
                                                ->delete();
                                    }
                                    if ($setting->name == 'data_retention') {
                                        DB::table('entity_user')->join('users', 'users.id', '=', 'entity_user.user_id')
                                                ->where(['users.system_user' => 0, 'entity_user.entity_id' => $entity->id, 'users.user_type_id' => $userType->id])
                                                ->update(array('entity_user.deleted_at' => now()));
                                    }
                                }
                                CronJobs::find($cronJob->id)->update(['status' => CronJobs::STATUS['DONE']]);
                            } catch (\Exception $exception) {
                                CronJobs::find($cronJob->id)->update(['status' => CronJobs::STATUS['failed'], 'raison' => $exception->getMessage()]);
                            }
                        }
                    }
                }
            }
        }

        $this->info('privacyManager:cron Cummand Run successfully!');
    }

}
