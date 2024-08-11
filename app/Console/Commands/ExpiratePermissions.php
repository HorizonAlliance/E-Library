<?php

namespace App\Console\Commands;

use App\Models\permissions;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpiratePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expirate-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update permissions status to "expirated" if the expiration date has passed';

    /**
     * Execute the console command.
     */

    // constructor
    public function __construct(){
        parent::__construct();
    }
    public function handle()
    {
        $now = Carbon::now();

        $expiredPermissions = permissions::where('expirated','<',$now )
                                ->where('status','accept')
                                ->whereNotNull('expirated')
                                ->get();
        foreach ($expiredPermissions as $permissions) {
            $permissions->status = 'expirated';
            $permissions->save();
        }

        $this->info('Expired permissions have been updated.');
        return 0;
    }
}
