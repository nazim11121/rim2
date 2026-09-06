@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Frontend CMS</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">AboutUs</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Add/Update</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">AboutUs</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('aboutUs.store') }}" enctype="multipart/form-data">
                            @csrf
                                <!-- Description -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Description <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="6" name="description" id="description" value="{{$allData->description ?? ''}}" required>{{$allData->description ?? ''}}</textarea>
                                    </div>
                                </div>
                                <!-- Tag1 -->
                                <!-- <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Tag1 </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="tag1" id="tag1" value="{{$allData->tag1??''}}">
                                    </div>
                                </div> -->
                                <!-- Tag2 -->
                                <!-- <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Tag2 </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="tag2" id="tag2" value="{{$allData->tag2??''}}">
                                    </div>
                                </div> -->
                                <!-- Tag3 -->
                                <!-- <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Tag3 </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="tag3" id="tag3" value="{{$allData->tag3??''}}">
                                    </div>
                                </div> -->
                                <!-- Image Upload -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Image</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="status" id="status" required>
                                            <option value="1" {{$allData->status??'' == 1 ?'Selected':''}}>Active</option>
                                            <option value="0" {{$allData->status??'' == 0 ?'Selected':''}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Buttons -->
                                <div class="text-end">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection