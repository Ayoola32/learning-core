@extends('admin.layouts.master')
@section('content')

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Course Languages</h3>

                            <!-- Page title actions -->
                            <div class="col-auto ms-auto d-print-none">
                                <div class="btn-list">
                                    <a href="#" class="btn btn-primary d-none d-sm-inline-block"
                                        data-bs-toggle="modal" data-bs-target="#modal-report">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Add New Language
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="card-body border-bottom py-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
