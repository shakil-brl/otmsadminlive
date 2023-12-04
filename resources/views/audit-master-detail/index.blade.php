@extends('layouts.auth-master')

@section('template_title')
    Audit Master Detail
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 m-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Audit Master Detail') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('audit-master-details.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
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

                                        <th>Auditmaster Id</th>
                                        <th>Audittasks Id</th>
                                        <th>Remark</th>
                                        <th>Document</th>
                                        <th>Updated At</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($auditMasterDetails as $auditMasterDetail)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $auditMasterDetail->auditmaster_id }}</td>
                                            <td>{{ $auditMasterDetail->audittasks_id }}</td>
                                            <td>{{ $auditMasterDetail->remark }}</td>
                                            <td>{{ $auditMasterDetail->document }}</td>
                                            <td>{{ $auditMasterDetail->Updated_at }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('audit-master-details.destroy', $auditMasterDetail->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('audit-master-details.show', $auditMasterDetail->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('audit-master-details.edit', $auditMasterDetail->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
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
                {!! $auditMasterDetails->links() !!}
            </div>
        </div>
    </div>
@endsection
