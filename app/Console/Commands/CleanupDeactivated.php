<?php

namespace App\Console\Commands;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\accounts\Accounts;
use App\Models\accounts\Like_Articles;
use App\Models\accounts\Like_Groups;
use App\Models\accounts\Like_Mountains;
use App\Models\accounts\Rate_Groups;
use App\Models\accounts\Rate_Mountains;
use App\Models\articles\Articles;
use App\Models\emails\Emails;
use App\Models\groups\Groups;
use App\Models\location\City;
use App\Models\location\Country;
use App\Models\mountains\Mountains;
use Illuminate\Support\Carbon;

use Illuminate\Console\Command;

class CleanupDeactivated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:deactivated';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $accountRecords = Accounts::whereNotNull('deactivated_date')
            ->where('deactivated_date', '<=', Carbon::now()->subMinute(5))
            ->get();

        foreach ($accountRecords as $record) {
            $record->rate_groups()->delete();
            $record->rate_mountains()->delete();
            $record->like_mountains()->delete();
            $record->like_groups()->delete();
            $record->like_article()->delete();
            $record->comments()->delete();
        
            $record->delete();
            $this->info("Account with ID $record->id has been deleted.");
        }

        $this->info('Cleanup completed.');
    }
}
