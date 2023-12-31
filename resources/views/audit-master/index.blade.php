@extends('layouts.auth-master')

@section('template_title')
    Audit Master
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 m-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Audit Master') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('audit-masters.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>User Id</th>
                                        <th>Batche Id</th>
                                        <th>Status</th>
                                        <th>Updated At</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($auditMasters as $auditMaster)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $auditMaster->user_id }}</td>
                                            <td>{{ $auditMaster->batche_id }}</td>
                                            <td>{{ $auditMaster->status }}</td>
                                            <td>{{ $auditMaster->Updated_at }}</td>

                                            <td>
                                                <form action="{{ route('audit-masters.destroy', $auditMaster->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('audit-masters.show', $auditMaster->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('audit-masters.edit', $auditMaster->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm  show-loader "><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $auditMasters->links() !!}
            </div>
        </div>
    </div>
@endsection
