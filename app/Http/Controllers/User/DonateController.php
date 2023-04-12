<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Donate;
use Illuminate\Http\Request;

class DonateController extends Controller
{

    public function __invoke()
    {

//        $stats = [
//
//            'total_count' => Donate::query()->count(),
//
//            'total_amount' => Donate::query()->sum('amount'),
//
//            'avg_amount' => Donate::query()->avg('amount'),
//
//            'min_amount' => Donate::query()->min('amount'),
//
//            'max_amount' => Donate::query()->max('amount'),
//
//        ];

        $statistics = Donate::query()
            ->select(['currency_id'])
            ->selectRaw('count(*) as total_count')
            ->selectRaw('sum(amount) as total_amount')
            ->selectRaw('avg(amount) as avg_amount')
            ->selectRaw('min(amount) as min_amount')
            ->selectRaw('max(amount) as max_amount')
            ->groupBy('currency_id')
            ->get();

//        dd($stats)

        return view('user.donates.index', compact('statistics'));

    }

}
