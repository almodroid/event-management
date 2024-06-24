<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::all(); // أو يمكنك تعديلها لجلب أحدث الفعاليات فقط إذا كان هناك عدد كبير من الفعاليات
        return view('welcome', compact('events'));
    }
}

