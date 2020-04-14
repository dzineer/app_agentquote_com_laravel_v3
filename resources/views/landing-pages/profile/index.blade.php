@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Landing Page Profile
@endsection

@section('content_header')
    <h1>Landing Page Profile</h1>
@stop

@section('content')
    <script>
            var pageCategories = {!! $pageCategories !!}
            var currentPageCategory = {!! $currentPageCategory !!}
            var ga_code = '{!! $ga_code !!}';
    </script>
    <div class="card">
        <div class="card-body">
            <h4 class="heading-info">Settings</h4>
            <div id="landing-page-profile"></div>
        </div>
    </div>
@stop
