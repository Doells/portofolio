<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\TambahTugas;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Detail, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TambahTugasTable extends PowerGridComponent
{
    use ActionButton;

    //Table sort field
    //public string $sortField = 'tambahtugas.created_at';
    public string $sortDirection = 'desc';

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'bulkCheckedDelete',
                'bulkCheckedEdit'
            ]
        );
    }

    /* public function header(): array
    {
        return [
            Button::add('bulk-checked')
                ->caption(__('Hapus'))
                ->class('bg-red-500 hover:bg-red-600 rounded-md text-white')
                ->emit('bulkCheckedDelete', []),
        ];
    } */

    public function bulkCheckedDelete()
    {
        if (auth()->check()) {
            $ids = $this->checkedValues();

            if (!$ids)
                return $this->dispatchBrowserEvent('showToast', ['success' => false, 'message' => 'Pilih data yang ingin dihapus terlebih dahulu.']);

            try {
                TambahTugas::whereIn('id', $ids)->delete();
                $this->dispatchBrowserEvent('showToast', ['success' => true, 'message' => 'Data tugas berhasil dihapus.']);
            } catch (\Illuminate\Database\QueryException $ex) {
                $this->dispatchBrowserEvent('showToast', ['success' => false, 'message' => 'Data gagal dihapus, kemungkinan ada data lain yang menggunakan data tersebut.']);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
            Footer::make()
                ->showPerPage()
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
     * @return Builder<\App\Models\TambahTugas>
     */
    public function datasource(): Builder
    {
        return TambahTugas::query();
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
            ->addColumn('title')
            ->addColumn('description')
            ->addColumn('lampiran', function (TambahTugas $model) {

                $lampiran = File::where('tambahtugas_id', $model->id)->exists();
                
                if($lampiran) {
                    $isLampiran = 'Ya';
                } else {
                    $isLampiran = 'Tidak';
                }
                // Kembalikan bagian pertama
                return $isLampiran;
            })
            ->addColumn('start_date')
            ->addColumn('end_date')
            ->addColumn('start_time')
            ->addColumn('batas_start_time')
            ->addColumn('input_type')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (TambahTugas $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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

            Column::make('Judul', 'title')
                ->searchable()
                ->makeInputText('title')
                ->sortable(),

            Column::make('Deskripsi', 'description'),

            Column::make('Lampiran', 'lampiran'),

            Column::make('Tanggal Mulai', 'start_date'),

            Column::make('Tanggal Selesai', 'end_date'),

            Column::make('Waktu Mulai', 'start_time', 'start_time')
                ->sortable(),

            Column::make('Waktu Selesai', 'batas_start_time', 'batas_start_time')
                ->sortable(),

            Column::make('Tipe Input', 'input_type', 'input_type')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->makeInputDatePicker()
                ->searchable()
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
     * PowerGrid tambahtugas Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('edit', 'Edit')
                ->class('bg-blue-500 hover:bg-blue-600 hover:underline rounded-full px-4 py-1 text-white my-2')
                ->target('')
                ->route('tambahtugas.edit', ['id' => 'id']),

            Button::make('destroy', 'Delete')
                    ->class('bg-red-500 hover:bg-red-600 hover:underline rounded-full px-4 py-1 text-white my-2 delete-btn')
                    ->target('')
                    ->route('tambahtugas.destroy', ['tambahtugas' => 'id'])
                    ->method('delete')
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
     * PowerGrid tambahtugas Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($tambahtugas) => $tambahtugas->id === 1)
                ->hide(),
        ];
    }
    */
}
