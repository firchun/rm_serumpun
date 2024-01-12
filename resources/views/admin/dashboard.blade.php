@extends('layouts.backend.admin')
@section('content')
    <div class="pc-container">
        <div class="pcoded-content">
            @include('layouts.backend.title')
            <div class="row">
                <div class="col-12">
                    @include('admin.component._count_items')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">

                    @include('admin.component._invoice')
                </div>
                <div class="col-lg-8">
                    @include('admin.component._menu')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('admin_theme/assets/plugins/amchart/core.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/charts.js') }}"></script>
    <script src="{{ asset('admin_theme/assets/plugins/amchart/themes/animated.js') }}"></script>
@endpush
