@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Tms Role Has Permission</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('permission.update', $tmsRoleHasPermission->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('tms-role-has-permission.form')

            </form>
        </div>
    </div>
@endsection
