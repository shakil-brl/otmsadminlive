@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
    <style>
        .close-detail {
            width: 38px;
        }
    </style>
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Update Product Combo
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
            <form action="{{ route('product-combos.update', $product_combo['id']) }}" method="post">
                @csrf
                @method('PUT')
                @include('product_combos.form')
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let productsData = @json($products);

        function drawProducts(productsData, selectProduct = null) {
            let products = '<select name="products[]" class="form-select">';
            products += '<option value="">Select product</option>';

            productsData.forEach(product => {
                products += '<option value="' + product.id + '"';
                if (selectProduct && selectProduct.product_id == product.id) {
                    products += ' selected';
                }
                products += '>' + product.name + '</option>';
            });

            products += '</select>';
            return products;
        }

        function drawQuantities(selectProduct = null) {
            let quantities = '<input type="number" class="form-control" name="quantities[]">';

            if (selectProduct) {
                quantities = '<input type="number" class="form-control" name="quantities[]" value="' + selectProduct
                    .quantity + '">';
            }

            return quantities;
        }

        let productDetails = @json($product_combo['combo_details']) ?? '';

        productDetails.forEach(detail => {
            addRow(detail);
        });

        generateSN();

        $("#add-item").click(function(e) {
            e.preventDefault();
            addRow();
            generateSN();
        });

        $(document).on('click', '.close-detail', function() {
            if ($('#detail-table-body tr').length > 1) {
                $(this).parent().parent().remove();
                generateSN();
            } else {
                alert('You can not remove first row.');
            }
        });

        function addRow(detail = null) {
            if (detail) {
                products = drawProducts(productsData, detail);
                quantities = drawQuantities(detail);
            } else {
                products = drawProducts(productsData);
                quantities = drawQuantities();
            }

            let row = `
            <tr>
                <td>
                    <div class="serial-no"></div>
                </td>
                <td class="products default">
                    ${products}
                </td>
                <td>
                    ${quantities}
                </td>
                <td>
                    <button type="button"
                        class="btn close-detail btn-danger d-flex justify-content-center align-items-center">
                        <span class="material-icons-outlined">
                            close
                        </span>
                    </button>
                </td>
            </tr>
        `;
            $("#detail-table-body").append(row);
        }

        function generateSN() {
            let allSerialElements = document.getElementsByClassName('serial-no');

            for (let index = 0; index < allSerialElements.length; index++) {
                allSerialElements[index].innerText = index + 1 + ".";
            }
        }
    </script>
@endpush
