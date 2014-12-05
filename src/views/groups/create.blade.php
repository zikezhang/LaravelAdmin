@extends(Config::get('admin::views.layout'))

@section('header')
    <h3>
        <i class="icon-group"></i>
        Groups
    </h3>
@stop

@section('help')
    <p class="lead">Groups</p>
    <p>
        Users can be placed into groups to manage permissions.
    </p>
    <br>
     <p class="text-info">
        For more info visit <a href="http://docs.cartalyst.com/sentry-2/permissions" target="_blank">Sentry website</a>
    </p>
@stop

@section('content')

{{ Former::horizontal_open(route('admin.groups.store')) }}

    <div class="row">
        <div class="span12">

            <div class="block">
                <p class="block-heading">Add New Group</p>
                <div class="block-body">
                    {{ Former::xlarge_text('name','Name')->required() }}
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="{{route('admin.groups.index')}}" class="btn">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <div class="block">
                <p class="block-heading">Group Permissions</p>
                <div class="block-body">
                    @include('admin::groups.permissions_form')
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a href="{{route('admin.groups.index')}}" class="btn">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{ Former::close() }}
@stop