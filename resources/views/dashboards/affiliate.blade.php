@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Dashboard
@endsection

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <div class="row my-20">
        <div class="col-md-12">


            {{--<div class="row my-20">

                <div class="col-md-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>100</h3>
                            <p>Quotes</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clipboard"></i>
                        </div>
                        <a href="/affiliate/reports/quotes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>3</h3>
                            <p>Reports</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>--}}

            <div class="row">

                <div class="col-md-3">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $counts['admins'] }}</h3>
                            <p>Administrators</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('affiliate.admins') }}" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $counts['groups'] }}</h3>
                            <p>Groups</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-object-group"></i>
                        </div>
                        <a href="{{ route('affiliate.groups.index') }}" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $counts['managers'] }}</h3>
                            <p>Managers</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('affiliate.managers') }}" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $counts['agents'] }}</h3>
                            <p>Agents</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('affiliate.agents') }}" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12 mb-20">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Last Login</h4>
                                </div>


                                <div class="col-md-12">
                                    <div class="">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Name</th>

                                                <th>Time</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <span class="font-medium link">Current Login</span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        <span class="font-medium link">{{ \Carbon\Carbon::createFromTimestamp(strtotime(auth()->user()->login_at))->isoFormat('LLL') }}</span></span>
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <div>
                                                        <span class="font-medium link">Last login</span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        <span class="font-medium link">{{ \Carbon\Carbon::createFromTimestamp(strtotime(auth()->user()->last_login_at))->isoFormat('LLL') }}</span></span>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>

    {{--<div class="row my-20">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Featured Ads</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body _fd3-table-responsive p-0">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>Type</th>
                            <th>Preferred Carrier</th>
                            <th>Text</th>
                            <th>Link</th>
                            <th>Click-Throughs</th>
                        </tr>
                        <tr>
                            <td>Underwritten Term</td>
                            <td>American General Life Insurance Company</td>
                            <td>UT Text Content</td>
                            <td>https://contractpagelink.com</td>
                            <td>1000</td>
                        </tr>
                        <tr>
                            <td>SI Term</td>
                            <td>Foresters Life Insurance & Annuity</td>
                            <td>SI Term Text Content</td>
                            <td>https://contractpagelink.com</td>
                            <td>200</td>
                        </tr>
                        <tr>
                            <td>Final Expense</td>
                            <td>Fidelity Life Association</td>
                            <td>Final Exprense Content</td>
                            <td>https://contractpagelink.com</td>
                            <td>500</td>
                        </tr>
                        </tbody></table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>--}}
    <div class="bulma-container">

        {{--        <p>
                    <button class="button is-primary is-large modal-button" id="new-group" data-target="modal" aria-haspopup="true">Launch example modal</button>
                </p>--}}

        <div class="modal" id="modal-window">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Add Group</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    @include('affiliate.partials.new_group')
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" id="save-button">Save changes</button>
                    <button class="button" id="cancel-button">Cancel</button>
                </footer>
            </div>
        </div>

    </div>

    <script>
        jQuery(function () {

            $('.group').on('change', function (e) {

                $('.group').removeClass('hide');
                $('.new-group-window').removeClass('show');

                let currentSelect = this;

                if ($(e.target).val() === 'Add Group') {

                    let form = $(this).prev();
                    form.addClass('show');
                    $(this).addClass('hide');
                    console.log('Pop up for adding group');
                    let parentTarget = this;

                    $(parentTarget).parent().find('.update-btn').on('click', function(e) {

                        let groupNameField = $(parentTarget).parent().find('.group_name');
                        let newOption = $('<option>' + groupNameField.val() + '</option>');
                        newOption.val(groupNameField.val());
                        $(currentSelect).find('.group-list').prepend(newOption);

                        let items2Complete = $('.group-list').filter(function(index, item) {
                            return $(item).find('option').val() !== groupNameField.val();
                        });

                        items2Complete.each(function(index, item) {
                            $(item).find('option')
                            let o = $('<option>' + groupNameField.val() + '</option>');
                            o.val(groupNameField.val());
                            $(item).prepend(o);
                        });

                        newOption.prop('selected', 'selected');
                        console.log(groupNameField.val(''));
                        $(parentTarget).removeClass('hide');
                        form.removeClass('show');
                        groupNameField.val('');
                        $(this).attr("onclick", "").unbind("click");
                    });
                }
            });
            $
            $('#new-group').on('click', function(e) {
                $('#modal-window').toggleClass('is-active');
            });
            $('body').on('click', function (e) {
                if (e.target.id === 'save-button') {
                    $('#modal-window').removeClass('is-active');
                } else if (e.target.id === 'cancel-button') {
                    $('#modal-window').removeClass('is-active');
                }
            })
        });
    </script>
    <style>
        .group {
            display: block;
        }
        .group.hide {
            display: none;
        }

        .new-group-window {
            display: none;
        }
        .new-group-window.show {
            display:block;
        }
        .center-text {
            text-align: center;
        }
    </style>
@stop