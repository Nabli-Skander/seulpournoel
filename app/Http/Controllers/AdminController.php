<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use App\Sondage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        if ( !Auth::user() || Auth::user() && !Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $usersCount = User::all()->count();
        $eventsCount = Event::all()->count();
        $sond = new Sondage;
        $sondageCount = sondage::all()->count();
        $sondage = json_decode($sond->index());

        return view('admin.home', compact('usersCount', 'eventsCount', 'sondageCount', 'sondage'));
    }

    public function exportUsers()
    {
        if (Auth::user() && !Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $data = User::get()->toArray();

        return Excel::create('spn_users_' . Carbon::now()->format('Y-m-d-H'), function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

    public function exportEvents()
    {
        if (Auth::user() && !Auth::user()->isAdmin()) {
            return redirect('/');
        }

        $data = Event::get()->toArray();

        return Excel::create('spn_events_' . Carbon::now()->format('Y-m-d-H'), function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
    }

}
