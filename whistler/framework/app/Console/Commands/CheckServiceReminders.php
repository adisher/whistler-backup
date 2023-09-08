<?php

namespace App\Console\Commands;

use App\Model\ServiceReminderModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceReminderEmail;

class CheckServiceReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:service-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and send service reminders based on next planned maintenance';

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
     * @return mixed
     */
    public function handle()
    {
        // Fetch all reminders
        $reminders = ServiceReminderModel::with('preventive_maintenance')->get();

        foreach ($reminders as $reminder) {
            $next_planned = $reminder->preventive_maintenance->next_planned;
            $last_meter = $reminder->last_meter;

            var_dump('$next_planned: ', $next_planned);
            var_dump('$last_meter: ', $last_meter);

            $upper_threshold = $next_planned + 50;
            $lower_threshold = $next_planned - 50;

            var_dump('$upper_threshold: ', $upper_threshold);
            var_dump('$lower_threshold: ', $lower_threshold);
            var_dump('$last_meter - $lower_threshold: ', $last_meter - $lower_threshold);
            var_dump('$last_meter - $upper_threshold: ', $last_meter - $upper_threshold);

            // Check if within 10 km of lower threshold
            if (abs($last_meter - $lower_threshold) <= 10) {
                dd('here 1');
                $emailTitle = "Upcoming Maintenance";
                $this->sendEmail($next_planned, $emailTitle);
            }

            // Check if within 10 km of upper threshold
            if (abs($last_meter - $upper_threshold) <= 10) {
                dd('here 2');
                $emailTitle = "Upcoming Maintenance";
                $this->sendEmail($next_planned, $emailTitle);
            }

            // Check if exceeded the upper threshold
            if ($last_meter > $upper_threshold) {
                dd('here 3');
                $emailTitle = "Missed Maintenance";
                $this->sendEmail($next_planned, $emailTitle);
            }
        }

        return true;

    }

    public function sendEmail($reminder, $emailTitle)
    {
        $recipients = explode(',', $reminder->preventive_maintenance->recipients);
        Mail::to($recipients)->send(new ServiceReminderEmail($next_planned, $emailTitle));
    }
}
