<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
{
    // Fetch applications for the authenticated user with additional details
    $applications = Application::with(['applicationType', 'location', 'institution', 'activity'])
        ->where('user_id', Auth::id())
        ->get();

    // Pass the applications data to the Inertia view
    return Inertia::render('Dashboard', [
        'applications' => $applications
    ]);
}

}
