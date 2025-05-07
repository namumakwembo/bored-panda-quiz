<?php

namespace App\Console\Commands;

use App\Models\QuizSession;
use Illuminate\Console\Command;

class CleanOldSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:clean-sessions';

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
        QuizSession::where('completed', false)
            ->where('created_at', '<', now()->subDays(7))
            ->delete();
        $this->info('Old sessions cleaned.');
    }
}
