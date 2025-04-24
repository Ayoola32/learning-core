@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Sub-Category for <span class="text-blue">{{ $course_category->name}}</span></h3>

                            <!-- Page title actions -->
                            <div class="card-actions">
                                <a href="{{ route('admin.sub-category.create', $course_category->id)}}" class="btn btn-primary btn-3">
                                    <i class="ti ti-plus"></i> 
                                    Add new
                                </a>
                            </div>
                        </div>


                        <div class="card-body border-bottom py-3">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
