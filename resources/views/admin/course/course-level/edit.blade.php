@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Level</h3>

                            <!-- Page title actions -->
                            <div class="card-actions">
                                <a href="{{ route('admin.course-level.index') }}" class="btn btn-primary btn-3">
                                    <i class="ti ti-arrow-back-up"></i> 
                                    Back 
                                </a>
                            </div>
                        </div>





                        <form action="{{ route('admin.course-level.update', $level->id)}}" method="POST" class="card">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Level</label>
                                    <div>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter a new level" value="{{ $level->name }}" required>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="text-start">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
