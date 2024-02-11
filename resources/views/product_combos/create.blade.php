@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
    <style>
        .detail-area {
            background: hsl(11, 100%, 91%);
        }
        .close-detail {
            width: 38px;
        }
    </style>
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Create Product Combo
        </h3>
        <x-alert />

        @if (session('error_message'))
            <ul class="m-0 text-danger">
                @foreach (session('error_message') ?? [] as $neme => $err)
                    @foreach ($err as $e)
                        <li>
                            {{ $e }}
                        </li>
                    @endforeach
                @endforeach
            </ul>
        @endif

        <div class="card p-5 mt-3">
            <form action="{{ route('products.store') }}" method="post">
                @csrf
                @include('product_combos.form')
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var products = '<select name="products[]" class="form-select">';
        @foreach ($products as $product)
            products += `<option value="{{ $product['id'] }}">{{ $product['name'] }}</option>`;
            @if ($loop->last)
                products += '</select>';
            @endif
        @endforeach
        $('.products').html(products);
        $("#add-item").click(function(e) {
            e.preventDefault();
            let row = `
            <tr>
                <td class="products default">
                    
                </td>
                <td>
                    <input type="text" class="form-control" name="quantity[]">
                </td>
                <td>
                    <button type="button"
                        class="btn close-detail btn-danger d-flex justify-content-center align-items-center">
                        <span class="material-symbols-outlined">
                            close
                        </span>
                    </button>
                </td>
            </tr>
        `;
            $("#detail-table-body").append(row);
            $('.products').html(products);
        });

        $(document).on('click', '.close-detail', function() {
            if ($('#detail-table-body tr').length > 1) {
                $(this).parent().parent().remove();
            } else {
                alert('You can not remove first row.');
            }
        });
    </script>
@endpush
