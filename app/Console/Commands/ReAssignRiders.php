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
        foreach ($deliveryOrders as $deliveryOrder) {
            $this->reAssignRider($deliveryOrder);
        }
        return Command::SUCCESS;
    }

    protected function reAssignRider($deliveryOrder)
    {
        // Get all riders that are available
        $order =  \App\Models\Orders::where('id', $deliveryOrder->order_id)->first();
        if (!$order) {
            Log::info('Order not found');
            return;
        }
        $controller = new \App\Http\Controllers\Controller();
        $controller->contactRiderAndVendor($order->order_id, $deliveryOrder->customer_id);

        Log::info('Re-assigning rider to order ' . $order->order_id);
        return;
    }
}
