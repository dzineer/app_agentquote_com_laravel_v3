@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Managers
@stop

@section('content_header')
    <h1>Managers</h1>
@stop

@section('content')

    <script>
        let affiliate_id = {!! $affiliate_id !!};
        let user = {!! $user !!};
        let users = {!! $managers !!};
        let groups = {!! $groups !!};
        let pagination = {!! $pagination !!}
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{--<h4>Agents list</h4>--}}

                    {{-- <div class="col-md-12">

                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{ count($admins) }}</h3>
                                        <p>Administrators</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>

                            </div>--}}

                    {{--                        <div class="col-md-6">

                                                    <div class="small-box bg-success">
                                                        <div class="inner">
                                                            <h3>{{ count($users) }}</h3>
                                                            <p>Users</p>
                                                        </div>
                                                        <div class="icon">
                                                            <i class="fa fa-users"></i>
                                                        </div>
                                                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                    </div>

                                                </div>--}}
                    <div id="managers-table" class="users-table"></div>

                </div>
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
        /*       jQuery(function () {

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
               });*/
    </script>
    <style>
        .center-text {
            text-align: center;
        }
    </style>
@stop