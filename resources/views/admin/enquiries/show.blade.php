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
                  <a href="#">Frontend Content</a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">Enquiries</a>
                </li>
                <li class="nav-item">
                  <a href="#">View</a>
                </li>
              </ul>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">Enquiry Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->name}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Email</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->email}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Phone</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->phone}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Subject</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->subject}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Message</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->message}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Type</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->type}}</p>
                                </div>
                            </div>

                            @if($data->room_type_id)
                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Room Type</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->roomType->name ?? ''}}</p>
                                </div>
                            </div>
                            @endif

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Check In</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->check_in}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Check Out</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->check_out}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Guests</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->guests}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Status</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{ucfirst($data->status)}}</p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-md-3 col-form-label">Created At</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">{{$data->created_at}}</p>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="text-end">
                                <a href="{{ route('admin.enquiries.index') }}" class="btn btn-secondary">Back to list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
