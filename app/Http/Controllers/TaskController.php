<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TaskController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();

        $todoTasks = DB::table('tb_task')
            ->join('tb_layanan', 'tb_task.layanan_id', '=', 'tb_layanan.id')
            ->leftJoin('tb_task_detail', 'tb_task.id', '=', 'tb_task_detail.task_id')
            ->leftJoin('tb_staff', 'tb_task_detail.staff_id', '=', 'tb_staff.id')
            ->select('tb_task.*', 'tb_layanan.name as layanan_nama', 'tb_staff.name as staff_name', DB::raw("DATEDIFF(finish_date, '$currentDate') as days_left"))
            ->where('tb_task.status', 'To Do')
            ->groupBy('tb_task.id', 'tb_task.name', 'tb_task.layanan_id', 'tb_task.start_date', 'tb_task.finish_date', 'tb_task.status', 'tb_layanan.name', 'tb_staff.name')
            ->get();

        $inProgressTasks = DB::table('tb_task')
            ->join('tb_layanan', 'tb_task.layanan_id', '=', 'tb_layanan.id')
            ->leftJoin('tb_task_detail', 'tb_task.id', '=', 'tb_task_detail.task_id')
            ->leftJoin('tb_staff', 'tb_task_detail.staff_id', '=', 'tb_staff.id')
            ->select('tb_task.*', 'tb_layanan.name as layanan_nama', 'tb_task_detail.progress', 'tb_staff.name as staff_name', DB::raw("DATEDIFF(finish_date, '$currentDate') as days_left"))
            ->where('tb_task.status', 'On progress')
            ->where('tb_task_detail.progress', '>', 0)
            ->groupBy('tb_task.id', 'tb_task.name', 'tb_task.layanan_id', 'tb_task.start_date', 'tb_task.finish_date', 'tb_task.status', 'tb_layanan.name', 'tb_task_detail.progress', 'tb_staff.name')
            ->get();

        $doneTasks = DB::table('tb_task')
            ->join('tb_layanan', 'tb_task.layanan_id', '=', 'tb_layanan.id')
            ->leftJoin('tb_task_detail', 'tb_task.id', '=', 'tb_task_detail.task_id')
            ->leftJoin('tb_staff', 'tb_task_detail.staff_id', '=', 'tb_staff.id')
            ->select('tb_task.*', 'tb_layanan.name as layanan_nama', 'tb_task_detail.progress', 'tb_staff.name as staff_name', DB::raw("DATEDIFF(finish_date, '$currentDate') as days_left"))
            ->where('tb_task.status', 'done')
            ->where('tb_task_detail.progress', '>', 0)
            ->groupBy('tb_task.id', 'tb_task.name', 'tb_task.layanan_id', 'tb_task.start_date', 'tb_task.finish_date', 'tb_task.status', 'tb_layanan.name', 'tb_task_detail.progress', 'tb_staff.name')
            ->get();

        $allTasks = DB::table('tb_task')->get();

        return view('task.index', compact('todoTasks', 'inProgressTasks', 'doneTasks', 'allTasks'));
    }
}
