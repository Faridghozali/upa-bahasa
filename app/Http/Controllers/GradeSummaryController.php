<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class GradeSummaryController extends Controller
{
    public function perMonth()
    {
        $gradesPerMonth = DB::table('grades')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month_year'),
                DB::raw('SUM(CASE WHEN grade < 400 THEN 1 ELSE 0 END) as cat1'),
                DB::raw('SUM(CASE WHEN grade BETWEEN 400 AND 489 THEN 1 ELSE 0 END) as cat2'),
                DB::raw('SUM(CASE WHEN grade BETWEEN 490 AND 559 THEN 1 ELSE 0 END) as cat3'),
                DB::raw('SUM(CASE WHEN grade BETWEEN 560 AND 644 THEN 1 ELSE 0 END) as cat4'),
                DB::raw('SUM(CASE WHEN grade BETWEEN 645 AND 670 THEN 1 ELSE 0 END) as cat5')
            )
            ->groupBy('month_year')
            ->orderBy('month_year', 'ASC')
            ->get();

        return response()->json([
            'data' => $gradesPerMonth
        ]);
    }
}
