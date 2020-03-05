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
                <h5 class="heading-info">{{ $customModule->module->name }} Module</h5>

                <div class="row">
                        <div class="col-md-6">
                            <div class="app d-flex justify-content-start align-items-start p-40">

                                <div class="module-logo-container">
                                    @if( $customModule->module->module_display_image )
                                        <img src="{{ $customModule->module->module_display_image }}" alt="Module Image">
                                    @else
                                        <span class="no-image-available">no image available</span>
                                    @endif
                                </div>
                                <div class="content-container">
                                    <div class="title">{{ $customModule->module->name }}</div>
                                    <div class="description">{{ $customModule->module->description }}</div>
                                    <span class="category">{{ $customModule->module->module_type->description }}</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 p-10 p-t-40">
                            <?php
                                $config = json_decode($customModule['data'], true);
                                // dd($config);
                            ?>

                                <form method="POST" action="/modules/{{ $customModule['id'] }}">
                                    @CSRF
                                    <input type="hidden" name="module" value="{{ $customModule->module->module_name }}" />
                                    <?php if( is_array($config) && count($config) ) : ?>
                                    @foreach( $config as $prop => $value )
                                    <?php
                                     $label =  ucfirst(str_replace("_", " ", $prop));
                                    ?>
                                    <div class="form-group row p-y-10">
                                        <label for="{{ $prop }}" class="col-sm-3 col-form-label">{{ $label }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="{{ $prop }}" value="{{ $value }}" />
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary btn-update">Update</button>
                                        </div>
                                    </div>

                                    <?php endif; ?>
                                </form>

                        </div>
                </div>
            </div>
        </div>

        <script>
            jQuery('.close-button').on('click', function() {
                jQuery('#app-module-modal').hide();
            });

            jQuery('.app-module').on('click', function() {
                debugger;

                let id = jQuery(this).attr('data-module-id');
                let name = jQuery(this).attr('data-module-name');
                let module_type = jQuery(this).attr('data-module-type');
                let module_config = jQuery(this).attr('data-module-config');

                debugger;

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



