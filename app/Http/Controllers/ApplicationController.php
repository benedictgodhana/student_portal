<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Log;
use App\Notifications\ApplicationSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationSubmitted as ApplicationSubmittedMail;

class ApplicationController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'application_type_id' => 'required|exists:application_types,id',
            'institution_id' => 'required|exists:institutions,id',
            'location_id' => 'required|exists:locations,id',
            'activity_id' => 'required|exists:activities,id',
            'preferred_start_date' => 'required|date',
            'description' => 'nullable|string',
            'cover_letter' => 'nullable|string',
            'status' => 'required|string',
        ]);

        try {
            // Create or update application record
            $application = Application::updateOrCreate(
                ['id' => $request->input('id', null)],
                array_merge(
                    $request->only([
                        'application_type_id',
                        'institution_id',
                        'location_id',
                        'activity_id',
                        'preferred_start_date',
                        'description',
                        'cover_letter',
                        'status',
                    ]),
                    ['user_id' => Auth::id()]
                )
            );

            // Log the application submission
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Application Submitted',
                'details' => 'Application ID: ' . $application->id .
                             ', Type: ' . $application->application_type_id .
                             ', Institution: ' . $application->institution_id .
                             ', Location: ' . $application->location_id .
                             ', Activity: ' . $application->activity_id .
                             ', Start Date: ' . $application->preferred_start_date,
            ]);

            // Send notification and email
            $this->sendNotificationAndEmail(Auth::user(), $application);

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!',
                'application' => $application
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the application: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function sendNotificationAndEmail($user, $application)
    {
        // Create notification
        $notification = [
            'title' => 'Application Submitted',
            'message' => 'Your application with ID ' . $application->id . ' has been successfully submitted.',
        ];

        // Save notification to the database
        $user->notifications()->create($notification);

        // Send notification via email
        Notification::route('mail', $user->email)
            ->notify(new ApplicationSubmitted($application));

        // Or using Mail facade directly
        Mail::to($user->email)->send(new ApplicationSubmittedMail($application));
    }
}
