@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-tachometer-alt"></i> @lang('navs.frontend.dashboard')
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-4 order-1 order-sm-2  mb-4">
                            <div class="card mb-4 bg-light">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                                <div class="card-body">
                                    <h4 class="card-title">
                                        {{ $logged_in_user->name }}<br/>
                                    </h4>

                                    <p class="card-text">
                                        <small>
                                            <i class="fas fa-envelope"></i> {{ $logged_in_user->email }}<br/>
                                            <i class="fas fa-calendar-check"></i> @lang('strings.frontend.general.joined') {{ timezone()->convertToLocal($logged_in_user->created_at, 'F jS, Y') }}
                                        </small>
                                    </p>

                                    <p class="card-text">
                                        @can('view backend')
                                            &nbsp;<a href="{{ route('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                                <i class="fas fa-user-secret"></i> @lang('navs.frontend.user.administration')
                                            </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>
                        </div><!--col-md-4-->

                        <div class="col-md-8 order-2 order-sm-1">
                            <div class="row">
                                <div class="col">
                                    <div class="card mb-4">
                                        <div class="card-header">
                                            Hello <b>{{ $logged_in_user->name }}</b><br>
                                            <small><b>Please check the below information related to your account created by Admin</b></small>
                                        </div><!--card-header-->

                                        <div class="card-body">
                                            <h4><b>Name:</b> <small>{{ $logged_in_user->name }}</small></h4>
                                            <h4><b>Email:</b> <small>{{ $logged_in_user->email }}</small></h4>
                                            <h4><b>DOB:</b> <small>{{ $logged_in_user->dob }}</small></h4>
                                            <h4><b>Country:</b> <small>{{ $logged_in_user->user_address->country->name }}</small></h4>
                                            <h4><b>DOB:</b> <small>{{ $logged_in_user->user_address->state->name }}</small></h4>
                                            <h4><b>DOB:</b> <small>{{ $logged_in_user->user_address->city }}</small></h4>
                                            <h4><b>DOB:</b> <small>{{ $logged_in_user->user_address->address }}</small></h4>
                                        </div><!--card-body-->
                                    </div><!--card-->
                                </div><!--col-md-6-->
                            </div><!--row-->
                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
