<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TambahTugas;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ResultTaskController extends Controller
{
    public function index()
    {
        $tambahtugas = TambahTugas::all()->sortByDesc('data.is_start');

        return response([
            'success' => true,
            'message' => 'List Semua Tugas, Urutkan berdasarkan tanggal mulai',
            'data' => $tambahtugas
        ], 200);
    }

    public function show($id)
    {
        $tambahtugas = TambahTugas::where('id', $id)->get();
        $hasilTugas = Task::where('tambahtugas_id', $id)
            ->with(['user' => function ($query) {
                $query->select('id', 'name', 'kelompok_id');
            }])
            ->get();

        return response([
            'success' => true,
            'message' => 'List Detail Tugas',
            'Data Tugas' => $tambahtugas,
            'Hasil Tugas' => $hasilTugas,
        ], 200);
    }

    public function showResultTaskUser($id)
    {
        $task = Task::where('id', $id)->with('files')->get()->first();

        return response([
            'success' => true,
            'message' => 'Detail Hasil Tugas Peserta',
            'data' => $task
        ], 200);
    }

    public function updateStatus(Request $request)
    {
        $validatedData = request()->validate([
            'status' => 'required|in:Terkirim,Proses,Revisi,Diterima',
        ]);

        $updateStatus = Task::whereId($request->input('id'))->update([
            'status' => $request->input('status'),
        ]);

        if ($updateStatus) {
            return response()->json([
                'success' => true,
                'message' => 'Status Tugas Berhasil Di Update!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Status Tugas Gagal Di Update!',
            ], 401);
        }
    }

    public function notSubmit(Request $request)
    {
        $byDate = [
            \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->toDateString(),
            \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->toDateString(),
        ];
        
        $requestByDate = request('display-by-date');
        
        if ($requestByDate && is_array($requestByDate)) {
            foreach ($requestByDate as $index => $date) {
                $requestByDate[$index] = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->toDateString();
            }
            $byDate = $requestByDate;
        }

        $dataTambahTugas = TambahTugas::where('id', $request->input('id_tambah_tugas'));
    
        $task = Task::query()
            ->where('tambahtugas_id', $dataTambahTugas->id)
            ->whereBetween('submit_date', $byDate)
            ->get(['submit_date', 'user_id']);
            
        $roleFilter = 'user'; // Ganti dengan peran yang ingin Anda tampilkan
    
        // Get participants or committee members based on position_id
        if ($task->isEmpty()) {
            $notSubmitData[] = 
            [
                "not_submit_date" => $byDate,
                "users" => User::query()
                    ->whereHas('role', function ($query) use ($roleFilter) {
                        $query->where('name', $roleFilter);
                    })
                    ->with('kelompok')
                    ->get()
                    ->toArray(),
            ];
        } else {
            $notSubmitData = $this->getNotSubmitStudents($task, $roleFilter);
        }
    
        return response([
            'success' => true,
            'message' => 'List Detail Tugas',
            'data' => $notSubmitData,
        ], 200);
    }

    

    private function getNotSubmitStudents($task, $roleFilter)
    {
        $uniqueSubmitDates = $task->unique("submit_date")->pluck('submit_date');
        $uniqueSubmitDatesAndCompactTheUserIds = $uniqueSubmitDates->map(function ($date) use ($task) {
            return [
                "submit_date" => $date,
                "user_id" => $task->where('submit_date', $date)->pluck('user_id')->toArray()
            ];
        });
        $notSubmitData = [];
        foreach ($uniqueSubmitDatesAndCompactTheUserIds as $tasks) {
            $notSubmitData[] =
                [
                    "not_submit_date" => $tasks['submit_date'],
                    "users" => User::query()
                        ->whereHas('role', function ($query) use ($roleFilter) {
                            $query->where('name', $roleFilter);
                        })
                        ->with('kelompok')
                        ->whereNotIn('id', $tasks['user_id'])
                        ->get()
                        ->toArray()
                ];
        }
        return $notSubmitData;
    }

    public function destroy($id)
    {
        $dataHasilTugas = Task::findOrFail($id);
        $dataHasilTugas->delete();

        if ($dataHasilTugas) {
            return response()->json([
                'success' => true,
                'message' => 'Data Hasil Tugas Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data Hasil Tugas Gagal Dihapus!',
            ], 400);
        }

    }
    
}
