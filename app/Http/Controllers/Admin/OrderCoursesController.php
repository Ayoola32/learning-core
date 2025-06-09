<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class OrderCoursesController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.orders-courses.index');
    }
}
