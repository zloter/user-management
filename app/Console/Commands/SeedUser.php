<?php

namespace App\Console\Commands;

use App\Employee;
use App\Lecturer;
use App\User;
use Carbon\Traits\Date;
use Illuminate\Console\Command;

class SeedUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "seed:users
        {--type=default  : one of: default, plain, lecturers, employee, both}
        {--amount=100000 : amount of faked account. Up to 10 000}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Seed users. You can add additional type to user by tags. \n
        By default about 1/3 will additionaly be an employee \n
        And 1/3 will be an lecturer (partially overlapping).";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->option('type');
        $amount = $this->option('amount');
        switch ($type) {
            case 'default':
                $employeesRate = 1/3;
                $lecturersRate = 1/3;
                break;
            case 'plain':
                $employeesRate = 0;
                $lecturersRate = 0;
                break;
            case 'employee':
                $employeesRate = 1;
                $lecturersRate = 0;
                break;
            case 'lecturer':
                $employeesRate = 0;
                $lecturersRate = 1;
                break;
            case 'both':
                $employeesRate = 1;
                $lecturersRate = 1;
                break;
            default:
                $this->error('Unknown flag. Aborting');
                return 1;
        }
        $this->addFakeUsers($employeesRate, $lecturersRate, $amount);
        return 0;
    }

    /**
     * @param float $employeesRate
     * @param float $lecturersRate
     * @param int $amount
     */
    private function addFakeUsers(float $employeesRate, float $lecturersRate, int $amount)
    {
        set_time_limit(60*60);
        ini_set('memory_limit','1024M');
        $start = time();

        $users = factory(User::class, $amount)
            ->create()
            ->each(function (User $user) use ($employeesRate, $lecturersRate) {
                $rand = mt_rand() / mt_getrandmax();
                if ($lecturersRate > $rand) {
                    $user->lecturer()->save(factory(Lecturer::class)->make());
                }
                $rand = mt_rand() / mt_getrandmax();
                if ($employeesRate > $rand) {
                    $user->employee()->save(factory(Employee::class)->make());
                }
            });


        $diff = time() - $start;
        $fullDays    = floor($diff/(60*60*24));
        $fullHours   = floor(($diff-($fullDays*60*60*24))/(60*60));
        $fullMinutes = floor(($diff-($fullDays*60*60*24)-($fullHours*60*60))/60);
        $seconds = floor(($diff-($fullDays*60*60*24)-($fullHours*60*60)-$fullMinutes*60));
        $this->info("Faking had taken $fullDays days, $fullHours hours and $fullMinutes minutes and $seconds s.");
    }
}
