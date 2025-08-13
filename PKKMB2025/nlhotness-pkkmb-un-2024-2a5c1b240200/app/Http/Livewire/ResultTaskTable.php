<?php

namespace App\Http\Livewire;

use App\Models\Presence;
use App\Models\TambahTugas;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ResultTaskTable extends PowerGridComponent
{
    use ActionButton;

    public $rowNumber = 1;
    public $tambahtugasId;
    //Table sort field
    public string $sortField = 'task.created_at';
    public string $sortDirection = 'desc';
    protected bool $isLate = false;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        //$this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
            Footer::make()
                ->showPerPage(10)
                ->showRecordCount()
                ->pagination('components.pagination'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Presence>
     */
    public function datasource(): Builder
    {
        return Task::query()
            ->where('tambahtugas_id', $this->tambahtugasId)
            ->join('users', 'task.user_id', '=', 'users.id')
            ->join('kelompoks', 'users.kelompok_id', '=', 'kelompoks.id')
            ->select('task.*', 'users.name as user_name', 'users.nim as user_nim', 'kelompoks.name as kelompok_name');

        
    }
    

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }


    /* Kehadiran Terlambat/TepatWaktu */
    protected function setLateStatus(Task $model)
    {   
        $waktuMasuk = \Carbon\Carbon::parse($model->submit_enter_time);
        $waktuTepatWaktu = \Carbon\Carbon::parse($model->tambahtugas->start_time);
        $waktuAkhirTepatWaktu = \Carbon\Carbon::parse($model->tambahtugas->batas_start_time); 
        $tanggalTepatWaktu = \Carbon\Carbon::parse($model->tambahtugas->start_date); 
        $tanggalAkhirTepatWaktu = \Carbon\Carbon::parse($model->tambahtugas->end_date); 
        $tanggalMasuk = \Carbon\Carbon::parse($model->submit_date);
    
        if ($waktuMasuk->isBefore($waktuAkhirTepatWaktu) && $tanggalMasuk->between($tanggalTepatWaktu, $tanggalAkhirTepatWaktu)) {
            return 'Tepat Waktu';
        } else {
            return 'Terlambat';
        }
    }
    

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('user_nim')
            ->addColumn('user_name')
            ->addColumn('kelompok_name')
            ->addColumn("submit_date")
            ->addColumn("submit_enter_time")
            ->addColumn('keterangan', fn(Task $model) => $this->setLateStatus($model))
            ->addColumn('status')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Task $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('NIM', 'user_nim')
                ->makeInputText('users.nim')
                ->searchable()
                ->sortable(),

            Column::make('Nama', 'user_name')
                ->makeInputText('users.name')
                ->searchable()
                ->sortable(),

            Column::make('Kelompok', 'kelompok_name')
                ->makeInputText('kelompoks.name')
                ->searchable()
                ->sortable(),

            Column::make('Tanggal Unggah', 'submit_date')
                /* ->makeInputDatePicker()
                ->searchable() */
                ->sortable(),

            Column::make('Jam Unggah', 'submit_enter_time')
                ->sortable(),

            Column::make('Status', 'status')
            ->makeInputText('')
            ->searchable()
            ->sortable(),

            Column::make('Keterangan', 'keterangan')
            ->makeInputText('')
            ->searchable()
            ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Presence Action Buttons.
     *
     * @return array<int, Button>
     */

    
    public function actions(): array
    {
       return [
           /* Button::make('destroy', 'Delete')
               ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->target('')
               ->route('result-task.destroy', ['task' => 'id'])
               ->method('delete'), */
           Button::make('showResultTaskUser', 'Lihat')
               ->class('bg-blue-500 hover:bg-blue-700 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->target('')
               ->route('result-task.showResultTaskUser', ['task' => 'id'])
        ];
    }
   

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Presence Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($presence) => $presence->id === 1)
                ->hide(),
        ];
    }
    */
}