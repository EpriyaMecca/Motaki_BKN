<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $header = 'Dashboard';
        $cardTittle = 'Master Data';

        // ini masukkin input apa aja yg mau di filter itu kan ada status sama date di modals
        // nah dia ambil namenya
        $statusFilter = $request->input('status');
        $dateFilter = $request->input('date');

        $query = DB::table('tb_staff')
            ->join('tb_position', 'tb_staff.position_id', '=', 'tb_position.id')
            ->join('tb_departement', 'tb_staff.departement_id', '=', 'tb_departement.id')
            ->leftJoin('tb_task', 'tb_staff.id', '=', 'tb_task.untuk_staff_id')
            ->select(
                'tb_staff.*',
                'tb_position.name as position_name',
                'tb_departement.name as departement_name',
                'tb_task.start_date',
                'tb_task.due_date',
                'tb_task.status',
                'tb_task.keterangan',
                'tb_task.Foto'
            );

        // trus ini buat filternya biar bisa dia filter apa disitu kan di tb_task.status sama di start date
        if ($statusFilter) {
            $query->where('tb_task.status', $statusFilter);
        }

        if ($dateFilter) {
            $query->whereDate('tb_task.start_date', $dateFilter);
        }


        $data = $query->get();

        $staffCount = DB::table('tb_staff')->count();
        $taskCount = DB::table('tb_task')->count();
        $taskDetailCount = DB::table('tb_task_detail')->count();
        $layananCount = DB::table('tb_layanan')->count();

        return view('dashboard', [
            'data' => $data,
            'staffCount' => $staffCount,
            'taskCount' => $taskCount,
            'taskDetailCount' => $taskDetailCount,
            'layananCount' => $layananCount,
            'header' => $header,
            'cardTittle' => $cardTittle
        ]);
    }
}
