@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Report</h1>
@stop

@section('content')

    <div class="row my-20">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Last 50 Quotes</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body__fd3-table-responsive p-0">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>User</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Age</th>
                        </tr>
                        <tr>
                            <td>Frankie Decker</td>
                            <td>Agent</td>
                            <td>Password Attempt Failed</td>
                            <td>April 9, 2019 - 10:15 am</td>
                        </tr>
                        <tr>
                            <td>Frankie Decker</td>
                            <td>Agent</td>
                            <td>Logged In</td>
                            <td>April 9, 2019 - 10:20 am</td>
                        </tr>
                        <tr>
                            <td>Frankie Decker</td>
                            <td>Agent</td>
                            <td>Logged Out</td>
                            <td>April 9, 2019 - 10:25 am</td>
                        </tr>
                        <tr>
                            <td>Frank Decker</td>
                            <td>Manager</td>
                            <td>Logged In</td>
                            <td>April 9, 2019 - 11:25 am</td>
                        </tr>
                        <tr>
                            <td>Frank Decker</td>
                            <td>Manager</td>
                            <td>Logged Out</td>
                            <td>April 9, 2019 - 12:25 am</td>
                        </tr>
                        </tbody></table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </div>
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