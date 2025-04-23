@extends('admin.layouts.master')
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add a New Language</h3>

                            <!-- Page title actions -->
                            <div class="card-actions">
                                <a href="{{ route('admin.course-language.index') }}" class="btn btn-primary btn-3">
                                    <i class="ti ti-arrow-back-up"></i> 
                                    Back 
                                </a>
                            </div>
                        </div>





                        <form action="{{ route('admin.course-language.store')}}" method="POST" class="card">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label required">Language</label>
                                    <div>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter a new language">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="text-start">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
