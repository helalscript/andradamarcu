<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\Donation;
use App\Models\UserDonation;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.layout.dashboard.index');
    }

    private function calculateDaysLeft($endTime)
    {
        $endTime = Carbon::parse($endTime);
        $today = Carbon::now();

        if ($today->lessThanOrEqualTo($endTime)) {
            // Calculate the difference in seconds
            $diffInSeconds = $today->diffInSeconds($endTime);

            // Calculate days, hours, minutes
            $countDaysLeft = floor($diffInSeconds / 86400); // Total days (1 day = 86400 seconds)
            $hours = floor(($diffInSeconds % 86400) / 3600); // Remaining hours
            $minutes = floor(($diffInSeconds % 3600) / 60); // Remaining minutes

            return "{$countDaysLeft} Days, {$hours} Hours, {$minutes} Minutes";
        }

        return "0 Days, 0 Hours, 0 Minutes"; // If end time has already passed
    }
}
