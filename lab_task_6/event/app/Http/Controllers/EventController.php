<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display all events
    public function index()
    {
        $events = [
            [
                'name' => 'Gaming Expo 2025',
                'date' => '2025-11-10',
                'location' => 'Lahore Convention Center',
                'status' => 'Upcoming'
            ],
            [
                'name' => 'AI Tech Conference',
                'date' => '2025-10-20',
                'location' => 'Islamabad',
                'status' => 'Ongoing'
            ],
            [
                'name' => 'Music Fest',
                'date' => '2025-09-01',
                'location' => 'Karachi Beach',
                'status' => 'Completed'
            ]
        ];

        return view('events', compact('events'));
    }

    // Show details of a single event
    public function details()
    {
        $event = [
            'name' => 'AI Tech Conference',
            'date' => '2025-10-20',
            'location' => 'Islamabad',
            'description' => 'A conference showcasing the latest in AI and machine learning.',
            'status' => 'Ongoing'
        ];

        return view('details', compact('event'));
    }

    // Show the form
    public function create()
    {
        return view('create');
    }

    // Handle form submission
    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['title']) || empty($data['date']) || empty($data['location']) || empty($data['description'])) {
            return back()->with('error', 'Please fill all fields');
        }

        return view('response', compact('data'));
    }
}
