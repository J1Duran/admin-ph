<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

class phEstadisticasController extends Controller
{

    /**
     * phEstadisticasController constructor.
     */
    public function index()
    {
        $days = Input::get('days', 7);

        $range = \Carbon\Carbon::now()->subDays($days);

        $stats = User::where('created_at', '>=', $range)
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->remember(1440)
            ->get([
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as value')
            ])
            ->toJSON();

        $this->layout->content = View::make('home', compact('stats'));

    }
}
