@extends('adminlte::page')

@section('title')
    Custom Modules
@endsection

@section('content_header')
    <h1>User Modules</h1>
@stop

@section('content')
    <div class="modal" id="app-module-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="title"></div>
                            <div class="tagline">No description available.</div>
                            <div class="description">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sidebar">
                                <div class="title"></div>

                                <strong>Category</strong>
                                <span class="category">-</span>
                                <strong>Support</strong>
                                <ul>
                                    -
                                </ul>
                                <strong>Integration Developer</strong>
                                <span><em class="developer">Agent Quoter Inc.</em></span>

                                <div class="management-buttons">
                                    <a href="#" id="action-button" class="btn btn-success btn-block btn-action"></a>
                                </div>

                                <div class="management-buttons">
                                    <a href="#" id="delete-button" class="btn btn-danger btn-block btn-action"></a>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" id="app-modal-close-btn" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="confirm-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close close-button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p>You are about to remove the  .</p>
                    <p>Do you want to proceed?</p>
                    <p class="debug-url"></p>
                </div>

                <div class="modal-footer">
                    <div class="management-buttons">
                        <a href="#" id="confirm-cancel-button" class="btn btn-secondary btn-block btn-action-confirm">Cancel</a>
                    </div>

                    <div class="management-buttons">
                        <form method="POST" id="delete_action" action="{{ $_SERVER['PHP_SELF'] }}">
                            @CSRF
                            <input type="hidden" name="action" value="delete" />
                            <input type="hidden" name="_method" value="DELETE" />
                            <button href="#" id="confirm-delete-button" class="btn btn-danger btn-block btn-action" data-module-name="">Remove Module</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="heading-info">Modules</h4>

{{--            <div class="row">
                <div class="col-md-12 modules-menu mb-3">
                    <div aria-label="Module Statuses" class="btn-group float-left" role="group">
                        <a class="nav-link btn btn-primary module-status-btn" data-toggle="active" href="#" id="module-featured" name="featured">Featured</a>
                        <a class="nav-link btn btn-secondary module-status-btn" data-toggle="active" href="#" id="module-browse" name="browse">Browse</a>
                        <a class="nav-link btn btn-secondary module-status-btn" data-toggle="active" href="#" id="module-active" name="active">Active</a>
                        --}}{{--<a class="nav-link btn btn-secondary" data-toggle="active" href="#" id="siwl_menu_item" name="siwl_menu_item">Search</a>--}}{{--
                    </div>
                </div>
            </div>--}}

            <h5 class="m-t-40 m-b-20 p-x-10" style="color: #3C8DBC;">Installed Modules</h5>

            <div class="row p-x-10">
                @foreach( $modules as $module )

		            <?php
		            $link = $module['in'] ? '/user/modules?module=' . strtolower($module['module_name']) : '/user/modules?module=' . strtolower($module['module_name']) . '&action=add';
		            $linkType = $module['in'] ? 'config' : 'add';
		            $hasModule = false;
		            $hasModule = array_key_exists('custom_module_id', $module);
		            $customModuleId = $hasModule ? $module['custom_module_id'] : '';
		            ?>

                    @if($hasModule)

                    <div class="col-md-3" id="parent-module-{{ $module['id'] }}">
                        <div class="card app">

                            <div class="card-body">

                                <a href="#" class="app-module" data-module-base-url="{{ url()->current() }}" data-module-id="{{ $module['id'] }}" data-has-module="{{ $hasModule }}" data-custom-module-id="{{ $customModuleId }}" data-module-title="{{ $module['name'] }}" data-module-name="{{ $module['module_name'] }}" data-module-type="{{ $module['module_type']['description'] }}" data-module-browse='true' <?php echo $module['status'] === 1 && $module['in'] ? "data-module-active='true'" : '' ?>  <?php echo $module['featured'] === 1 ? "data-module-featured='true'" : '' ?>  data-module-linktype="{{  $linkType }}" data-module-config="{{ $link }}" >
                                    <div class="logo-container">
                                        @if( $module['module_image'] )
                                            <img src="{{ $module['module_image'] }}" alt="Module Image">
                                        @else
                                            <span class="no-image-available">no image available</span>
                                        @endif
                                    </div>
                                    <div class="content-container">
                                        <div class="title">{{ $module['name'] }}</div>
                                        <div class="description">{{ $module['description'] }}</div>
                                        <span class="category">{{ $module['module_type']['description'] }}</span>

                                    </div>

                                    @if( $module['featured'] === 1 )
                                        <span class="popular-star"><i class="fa fa-star"></i></span>
                                    @else
                                        <span class="no-popular-star"><i class="fa fa-star"></i></span>
                                    @endif
                                </a>

                            </div>
                        </div>
                    </div>
                    @endif

                @endforeach
            </div>

            <h5 class="m-t-40 m-b-20 p-x-10" style="color: #3C8DBC;">Available Modules</h5>

            <div class="row p-x-10">
                @foreach( $modules as $module )

			        <?php
			        $link = $module['in'] ? '/user/modules?module=' . strtolower($module['module_name']) : '/user/modules?module=' . strtolower($module['module_name']) . '&action=add';
			        $linkType = $module['in'] ? 'config' : 'add';
			        $hasModule = false;
			        $hasModule = array_key_exists('custom_module_id', $module);
			        $customModuleId = $hasModule ? $module['custom_module_id'] : '';
			        ?>

                    @if( ! $hasModule )

                    <div class="col-md-3" id="parent-module-{{ $module['id'] }}">
                        <div class="card app">

                            <div class="card-body">

                                <a href="#" class="app-module" data-module-base-url="{{ url()->current() }}" data-module-id="{{ $module['id'] }}" data-has-module="{{ $hasModule }}" data-custom-module-id="{{ $customModuleId }}" data-module-title="{{ $module['name'] }}" data-module-name="{{ $module['module_name'] }}" data-module-type="{{ $module['module_type']['description'] }}" data-module-browse='true' <?php echo $module['status'] === 1 && $module['in'] ? "data-module-active='true'" : '' ?>  <?php echo $module['featured'] === 1 ? "data-module-featured='true'" : '' ?>  data-module-linktype="{{  $linkType }}" data-module-config="{{ $link }}" >
                                    <div class="logo-container">
                                        @if( $module['module_image'] )
                                            <img src="{{ $module['module_image'] }}" alt="Module Image">
                                        @else
                                            <span class="no-image-available">no image available</span>
                                        @endif
                                    </div>
                                    <div class="content-container">
                                        <div class="title">{{ $module['name'] }}</div>
                                        <div class="description">{{ $module['description'] }}</div>
                                        <span class="category">{{ $module['module_type']['description'] }}</span>

                                    </div>

                                    @if( $module['featured'] === 1 )
                                        <span class="popular-star"><i class="fa fa-star"></i></span>
                                    @else
                                        <span class="no-popular-star"><i class="fa fa-star"></i></span>
                                    @endif
                                </a>

                            </div>
                        </div>
                    </div>
                    @endif

                @endforeach
            </div>

        </div>
    </div>

    <script>

/*        jQuery(function() {
            let filter = 'browser';

            jQuery('.module-status-btn').each(function () {
                jQuery(this).removeClass('btn-primary').removeClass('btn-secondary');
                if ( jQuery(this).attr('name') === filter ) {
                    jQuery(this).addClass('btn-primary');
                } else {
                    jQuery(this).addClass('btn-secondary');
                }
            });

            jQuery('.app-module').each(function () {
                let module_id = jQuery(this).attr('data-module-id');
                if ( jQuery(this).attr('data-module-' + filter) ) {
                    jQuery('#parent-module-' + module_id).show();
                } else {
                    jQuery('#parent-module-' + module_id).hide();
                }

            })
        });*/

        jQuery('.close-button').on('click', function(e) {
            e.preventDefault();
            jQuery('#app-module-modal').hide();
        });

        jQuery('.module-status-btn').on('click', function(e) {
            e.preventDefault();
            let filter = jQuery(this).attr('name');

            jQuery('.module-status-btn').each(function () {
                jQuery(this).removeClass('btn-primary').removeClass('btn-secondary');
                if ( jQuery(this).attr('name') === filter ) {
                    jQuery(this).addClass('btn-primary');
                } else {
                    jQuery(this).addClass('btn-secondary');
                }
            });

            jQuery('.app-module').each(function () {
                let module_id = jQuery(this).attr('data-module-id');
                if ( jQuery(this).attr('data-module-' + filter) ) {
                    jQuery('#parent-module-' + module_id).show();
                } else {
                    jQuery('#parent-module-' + module_id).hide();
                }

            })
        });

        jQuery('#delete-button').on('click', function(e) {
            e.preventDefault();

            let modal = jQuery('#app-module-modal');
            let deleteModal = jQuery('#confirm-delete');

            jQuery('#confirm-delete').find('.modal-body').html(
                '<p>' + 'You are about to remove the ' + jQuery(this).attr('data-module-name') + '</p>' +
                '<p>' + 'Deleting this module will delete your settings for this module.' + '</p>' +
                '<p>' + 'Are You sure you want to proceed?' + '</p>' +
                '<p class="debug-url">' + '' + '</p>'
            );

            let actionButton = jQuery('#delete_action')
            let action = actionButton.attr("action");
            let moduleConfig = jQuery(this).attr('data-module-base-url');

            debugger;

            action = moduleConfig + '/' + jQuery(this).attr('data-custom-module-id');
            actionButton.attr('action', action);

            jQuery('#confirm-cancel-button').on('click', function(e) {
                e.preventDefault();
                let modal = jQuery('#app-module-modal');
                let deleteModal = jQuery('#confirm-delete');

                /*                let sidebar = modal.find('.sidebar');
                                sidebar.find('#action-button').attr('href', '#');
                                sidebar.find('#delete-button').attr('href', '#');*/

                deleteModal.hide();
                modal.show();
            });

            modal.hide();
            deleteModal.show();
        });

        jQuery('.app-module').on('click', function(e) {
            e.preventDefault();
            debugger;

            let id = jQuery(this).attr('data-module-id');
            let name = jQuery(this).attr('data-module-name');
            let title = jQuery(this).attr('data-module-title');
            let module_baseURL = jQuery(this).attr('data-module-base-url');
            let module_type = jQuery(this).attr('data-module-type');
            let module_config = jQuery(this).attr('data-module-config');
            let module_linktype = jQuery(this).attr('data-module-linktype');
            let has_customModule = jQuery(this).attr('data-has-module');

            customModuleId = '';

            if (has_customModule === '1') {
                customModuleId = jQuery(this).attr('data-custom-module-id');
            }

            // module_config = module_config.replace(/[^A-Z0-9\/\?=]+/ig, "-");

            module_config = module_config.replace(/\s+/g, '-').toLowerCase();

            debugger;

            let modal = jQuery('#app-module-modal');

            modal.find('.title').html( title );
            modal.find('.description').html( title );

            let sidebar = modal.find('.sidebar');
            sidebar.find('.title').html( title );
            sidebar.find('.category').html( module_type );
            sidebar.find('.developer').html( 'Agent Quote Inc.' );
            sidebar.find('.module-name').val( name.toLowerCase() );
            sidebar.find('#action-button').attr('href', module_config);
            sidebar.find('#delete-button').attr('href', module_config);

            if (module_linktype === 'add') {
                jQuery('#action-button').html('Add Module');
                jQuery('#delete-button').hide();
            } else {
                jQuery('#action-button').html('Configure Module');
                jQuery('#delete-button').html('Delete Module');
                jQuery('#delete-button').attr('data-module-name', title);
                jQuery('#delete-button').attr('data-delete-module-id', id);
                jQuery('#delete-button').attr('data-delete-module-name', name.toLowerCase());
                jQuery('#delete-button').attr('data-custom-module-id', customModuleId);
                debugger;
                jQuery('#delete-button').attr('data-module-base-url', module_baseURL);
            }

            modal.show();
        })
    </script>

@stop