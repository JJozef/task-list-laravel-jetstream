<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tasks;
use Carbon\Carbon;

class ExpireTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Marca las tareas expiradas como "Expiradas"';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDate = Carbon::now();

        $expiredTasks = Tasks::where('state_id', '!=', 3)
                    ->where('deadline', '<', $currentDate)
                    ->get();
        foreach ($expiredTasks as $task) {
            $task->state_id = 5; 
            $task->save();
        }
    }
}
