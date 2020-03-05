@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: My Quotes
@endsection

@section('content_header')
    <h1>My Quotes</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Message</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row">1</td>
                    <td>Tony</td>
                    <td>Sarlese</td>
                    <td>tsarlese@agentquote.com</td>
                    <td><a href="#"><span class="fa fa-file"></span></a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
