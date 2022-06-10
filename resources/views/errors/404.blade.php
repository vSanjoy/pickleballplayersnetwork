@extends('errors.layouts.error', ['title' => 'Page Not Found'])

@section('content')

    <div class="col-lg-8 col-md-7">
        <div class="p-3">
            <div id="error-found">
                <div class="notfound">
                    <div class="notfound-404 mb-4-5">
                        <h1>@lang('custom_admin.message_oops')</h1>
                    </div>
                    <h2 class="text-dark mb-4-5 font-weight-medium text-centre">
                        @lang('custom_admin.label_404')
                    </h2>
                    <p>@lang('custom_admin.message_page_not_found')</p>
                    <a class="btn btn-primary waves-effect waves-light btn-rounded shadow-md pr-3 pl-3 mt-3" href="{{ url('/') }}">
                        <i class="far fa-arrow-alt-circle-left"></i> @lang('custom_admin.label_go_back')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
