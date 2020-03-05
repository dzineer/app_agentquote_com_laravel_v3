@extends('adminlte::page')

@section('title')
    Custom Modules
@endsection

@section('content_header')
    <h1>Module Config</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="heading-info">{{ $customModule->module->name }}</h5>

            <div class="row">
                <div class="col-md-12">
                    <div id="page-choice-module-edit" class="p-x-20">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        customModule = {!! $customModule !!}
        supportedCustomModules = {!! $supportedCustomModules !!}

        jQuery('.close-button').on('click', function() {
            jQuery('#app-module-modal').hide();
        });

        jQuery('.app-module').on('click', function() {
            // debugger;

            let id = jQuery(this).attr('data-module-id');
            let name = jQuery(this).attr('data-module-name');
            let module_type = jQuery(this).attr('data-module-type');
            let module_config = jQuery(this).attr('data-module-config');

            // debugger;

            let modal = jQuery('#app-module-modal');

            modal.find('.title').html( name );
            modal.find('.description').html( name );

            let sidebar = modal.find('.sidebar');
            sidebar.find('.title').html( name );
            sidebar.find('.category').html( module_type );
            sidebar.find('.developer').html( 'Agent Quote Inc.' );
            sidebar.find('.module-name').val( name.toLowerCase() );
            sidebar.find('.management-buttons form').attr('action', module_config);

            modal.show();
        })
    </script>

@stop



