<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('instructor', function($query){
                return $query->instructor_id ? $query->instructor->first_name . ' ' . $query->instructor->last_name: 'N/A';
            })
            ->addColumn('price', function($query){
                return $query->price ? '$' . $query->price : 'Free';
            })
            ->addColumn('action', function ($query) {
                return '
                    <a href="' . route('admin.courses.edit', $query->id) . '" class="btn-sm text-info">
                        <i class="ti ti-list"></i>
                    </a> 
                    <a href="' . route('admin.courses.edit', $query->id) . '" class="btn-sm btn-primary">
                        <i class="ti ti-edit"></i>
                    </a> 
                    <a href="' . route('admin.courses.edit', $query->id) . '" class="btn-sm text-red delete-item">
                        <i class="ti ti-trash"></i>
                    </a>
                ';
            })
            ->rawColumns(['instructor', 'action', 'price'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Course $model): QueryBuilder
    {
        return $model->newQuery()->with('instructor');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('course-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0)
                    // ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
       return [
            Column::make('title')->className('text-center'),
            Column::make('price')->className('text-center'),
            Column::make('instructor')->className('text-center'),
            Column::make('status')->className('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Course_' . date('YmdHis');
    }
}