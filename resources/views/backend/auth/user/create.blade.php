@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.auth.user.store'))->class('form-horizontal')->id('create_user_form')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.users.management')
                            <small class="text-muted">@lang('labels.backend.access.users.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                            <div class="col-md-10">
                                {{ html()->text('first_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                            <div class="col-md-10">
                                {{ html()->text('last_name')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                            <div class="col-md-10">
                                {{ html()->email('email')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.email'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Username')->class('col-md-2 form-control-label')->for('username') }}

                            <div class="col-md-10">
                                {{ html()->text('username')
                                    ->class('form-control')
                                    ->placeholder('username')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.password'))->class('col-md-2 form-control-label')->for('password') }}

                            <div class="col-md-10">
                                {{ html()->password('password')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.password'))
                                    ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.users.password_confirmation'))->class('col-md-2 form-control-label')->for('password_confirmation') }}

                            <div class="col-md-10">
                                {{ html()->password('password_confirmation')
                                    ->class('form-control')
                                    ->placeholder(__('validation.attributes.backend.access.users.password_confirmation'))
                                    ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Date of Birth')->class('col-md-2 form-control-label')->for('dob') }}

                            <div class="col-md-10">
                                {{ html()->date('dob')
                                    ->class('form-control')
                                    ->placeholder('Date of Birth')
                                    ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Country')->class('col-md-2 form-control-label')->for('country_id') }}

                            <div class="col-md-10">
                                {{ html()->select('country_id')
                                ->options($countries)
                                ->class('form-control')
                                ->placeholder('Select Country')
                                ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('State')->class('col-md-2 form-control-label')->for('state_id') }}

                            <div class="col-md-10">
                                {{ html()->select('state_id')
                                ->class('form-control')
                                ->placeholder('Select State')
                                ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('City')->class('col-md-2 form-control-label')->for('city') }}

                            <div class="col-md-10">
                                {{ html()->text('city')
                                    ->class('form-control')
                                    ->placeholder('City')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Address')->class('col-md-2 form-control-label')->for('address') }}

                            <div class="col-md-10">
                                {{ html()->textarea('address')
                                    ->class('form-control')
                                    ->placeholder('Enter your full address')
                                    ->required() }}
                                <small class="user_validation_error"></small>
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        <button class="btn btn-success btn-sm pull-right" type="submit" id="create_user_btn">Create</button>
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
    <input type="hidden" id="check_username" value="n">
    <input type="hidden" id="check_email" value="n">

    <div id="turn_the_loader" class="loading d-none">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
@endsection


@push('after-styles')
    <style>
        /**
        Loading snipper
        -------------------------
        */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            text-align: center;
            z-index: 9999;
        }
        .spinner {
            position: absolute;
            top: 0;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            width: 100px;
            height: 100px;
            text-align: center;
            font-size: 10px;
            background-color: rgba(0, 0, 0, 0.2);
            padding: 25px;
            border-radius: 10%;
        }
        .spinner > div {
            z-index: 999;
            background-color: #FF7800;
            height: 100%;
            width: 6px;
            display: inline-block;
            -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
            animation: sk-stretchdelay 1.2s infinite ease-in-out;
        }
        .spinner .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }
        .spinner .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }
        .spinner .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }
        .spinner .rect5 {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }
        @-webkit-keyframes sk-stretchdelay {
            0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
            20% { -webkit-transform: scaleY(1.0) }
        }
        @keyframes sk-stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }  20% {
                   transform: scaleY(1.0);
                   -webkit-transform: scaleY(1.0);
               }
        }
    </style>
@endpush


@push('after-scripts')
    <script>
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    {!! script('js/user_create.js') !!}
@endpush
