<?php

namespace App\Console\Commands;

use App\Mail\ServiceReminderEmail;
use App\Model\ServiceReminderModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
        $this->info("Starting service reminders check...");

        // Fetch all reminders
        $reminders = ServiceReminderModel::with('preventive_maintenance')->get();
        $logMessages = [];

        foreach ($reminders as $reminder) {
            $next_planned = $reminder->preventive_maintenance->next_planned;
            $last_meter = intval($reminder->last_meter); // Convert to integer to ensure type consistency

            $upper_threshold = $next_planned + 50;
            $lower_threshold = $next_planned - 50;

            // var_dump('$next_planned: ', $next_planned);
            // var_dump('$upper_threshold: ', $upper_threshold);
            // var_dump('$lower_threshold: ', $lower_threshold);
            // var_dump('$last_meter <= $lower_threshold: ', $last_meter <= $lower_threshold);
            // var_dump('$last_meter >= $upper_threshold: ', $last_meter >= $upper_threshold);
            // var_dump('$last_meter > $upper_threshold: ', $last_meter > $upper_threshold);

            // Check if last_meter is within or equal to the lower threshold
            if ($last_meter <= $lower_threshold) {
                $emailTitle = "Upcoming Maintenance";
                $this->sendEmail($reminder, $emailTitle);
                $logMessages[] = "Sent Upcoming Maintenance reminder for next_planned: $next_planned.";
            }

            // Check if last_meter is within or equal to the upper threshold
            if ($last_meter >= $upper_threshold) {
                $emailTitle = "Overdue Maintenance";
                $this->sendEmail($reminder, $emailTitle);
                $logMessages[] = "Sent Overdue Maintenance reminder for next_planned: $next_planned.";
            }

            if ($last_meter > $upper_threshold) {
                $emailTitle = "Missed Maintenance";
                $this->sendEmail($reminder, $emailTitle);
                $logMessages[] = "Sent Missed Maintenance reminder for next_planned: $next_planned.";
            }
        }

        // var_dump(is_writable(storage_path('cronlogs/preventive-maintenance.log')));


        // Print log messages
        foreach ($logMessages as $message) {
            $this->info($message); // This will be captured by appendOutputTo()
            Log::channel('preventive_maintenance')->info($message); // This will be captured by sendOutputTo()
        }
        $this->info("Service reminders check completed.");


    }

    public function sendEmail($reminder, $emailTitle)
    {
        $recipients = explode(',', $reminder->preventive_maintenance->email_to);
        var_dump($recipients);
        Mail::to($recipients)->send(new ServiceReminderEmail($reminder, $emailTitle));
    }
}
