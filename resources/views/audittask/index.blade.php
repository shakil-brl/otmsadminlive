@extends('layouts.auth-master')

@section('template_title')
    Audittask
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 m-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Audittask') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('audittasks.create') }}" class="btn btn-primary btn-sm float-right"
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

                                        <th>Training Title Id</th>
                                        <th>Batchcode Id</th>
                                        <th>Subject</th>
                                        <th>Instruction</th>
                                        <th>Status</th>
                                        <th>Updated At</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audittasks as $audittask)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $audittask->training_title_id }}</td>
                                            <td>{{ $audittask->batchCode_id }}</td>
                                            <td>{{ $audittask->subject }}</td>
                                            <td>{{ $audittask->instruction }}</td>
                                            <td>{{ $audittask->status }}</td>
                                            <td>{{ $audittask->Updated_at }}</td>

                                            <td>
                                                <form action="{{ route('audittasks.destroy', $audittask->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('audittasks.show', $audittask->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('audittasks.edit', $audittask->id) }}"><i
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
                {!! $audittasks->links() !!}
            </div>
        </div>
    </div>
@endsection
