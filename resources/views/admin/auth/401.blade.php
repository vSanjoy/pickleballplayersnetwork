@extends('admin.layouts.error', ['title' => $pageTitle])

@section('content')

    <div class="col-lg-5 col-md-7">
        <div class="p-3">
            <div id="error-found">
                <div class="notfound">
                    <div class="notfound-404 mb-3">
                        <h1>@lang('custom_admin.message_oops')</h1>
                    </div>
                    <h3 class="page-title text-center text-dark font-weight-medium">
                        @lang('custom_admin.label_401') - {{ $pageTitle }}
                    </h2>                    
                    <a class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 mt-3" href="{{ route('admin.login') }}">
                        <i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.label_back_to_sign_in')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
