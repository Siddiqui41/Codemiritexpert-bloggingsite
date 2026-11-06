<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Newsletter::latest()->paginate(20);
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        $subscriber = Newsletter::findOrFail($id);
        $subscriber->delete();
        return back()->with('success', 'Subscriber removed from distribution list.');
    }
}
