<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignAdminRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:admin {userEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns admin role to user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $userEmail = $this->argument('userEmail');
            $user = User::where('email', $userEmail)->first();
            if (!$user) {
                $this->error("Invalid UserEmail $userEmail");
            }
            $user->is_admin = true;
            if ($user->save()) {
                $this->info("User with email $userEmail now has admin permission");
            }
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
