<?php

namespace App\Console\Commands;

use App\Models\DeliveryRequestStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ReAssignRiders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'riders:reassign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-assign riders to orders that have been unassigned due to rider unavailability';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get all orders that have been unassigned
        $deliveryOrders = DeliveryRequestStatus::where('delivery_status', 0)->where('created_at', '>', Carbon::now()->subMinutes(10))->get();

        if (!$deliveryOrders) {
            Log::info('No Orders awaiting re-assignment');
            return Command::SUCCESS;
        }

        $order =  \App\Models\Orders::where('id', $deliveryOrders->order_id)->first();
        if (!$order) {
            Log::info('Order not found');
            return Command::SUCCESS;
        }
        $controller = new \App\Http\Controllers\Controller();
        $controller->contactRiderAndVendor($deliveryOrders->order_id, $deliveryOrders->customer_id);
        return Command::SUCCESS;
    }
}
