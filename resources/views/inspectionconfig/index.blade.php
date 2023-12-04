@extends('layouts.auth-master')

@section('template_title')
    Inspectionconfig
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Inspectionconfig') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('inspectionconfigs.create') }}" class="btn btn-primary btn-sm float-right"
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

                                        <th>Batche Id</th>
                                        <th>User Id</th>
                                        <th>Classnum</th>
                                        <th>Labsize</th>
                                        <th>Electricity</th>
                                        <th>Internet</th>
                                        <th>Labbill</th>
                                        <th>Labattandance</th>
                                        <th>Computer</th>
                                        <th>Router</th>
                                        <th>Projectortv</th>
                                        <th>Usinglaptop</th>
                                        <th>Labsecurity</th>
                                        <th>Labreagister</th>
                                        <th>Classreagulrity</th>
                                        <th>Teacattituted</th>
                                        <th>Teaclabatten</th>
                                        <th>Upojelaodit</th>
                                        <th>Upozelamonotring</th>
                                        <th>Remark</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inspectionconfigs as $inspectionconfig)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $inspectionconfig->batche_id }}</td>
                                            <td>{{ $inspectionconfig->user_id }}</td>
                                            <td>{{ $inspectionconfig->classnum }}</td>
                                            <td>{{ $inspectionconfig->labsize }}</td>
                                            <td>{{ $inspectionconfig->electricity }}</td>
                                            <td>{{ $inspectionconfig->internet }}</td>
                                            <td>{{ $inspectionconfig->labbill }}</td>
                                            <td>{{ $inspectionconfig->labattandance }}</td>
                                            <td>{{ $inspectionconfig->computer }}</td>
                                            <td>{{ $inspectionconfig->router }}</td>
                                            <td>{{ $inspectionconfig->projectortv }}</td>
                                            <td>{{ $inspectionconfig->usinglaptop }}</td>
                                            <td>{{ $inspectionconfig->labsecurity }}</td>
                                            <td>{{ $inspectionconfig->labreagister }}</td>
                                            <td>{{ $inspectionconfig->classreagulrity }}</td>
                                            <td>{{ $inspectionconfig->teacattituted }}</td>
                                            <td>{{ $inspectionconfig->teaclabatten }}</td>
                                            <td>{{ $inspectionconfig->upojelaodit }}</td>
                                            <td>{{ $inspectionconfig->upozelamonotring }}</td>
                                            <td>{{ $inspectionconfig->remark }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('inspectionconfigs.destroy', $inspectionconfig->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('inspectionconfigs.show', $inspectionconfig->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('inspectionconfigs.edit', $inspectionconfig->id) }}"><i
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
                {!! $inspectionconfigs->links() !!}
            </div>
        </div>
    </div>
@endsection
