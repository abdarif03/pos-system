@extends('layouts.app')

@section('content')
<h4>Buat Transaksi</h4>

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf
    <table class="table" id="product-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <button type="button" class="btn btn-secondary" id="add-item">+ Tambah Item</button>
    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
</form>

<script>
    let products = @json($products);
    function renderRow() {
        let options = products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`).join('');
        return `<tr>
            <td><select name="items[][product_id]" class="form-select product-select">${options}</select></td>
            <td><input type="number" name="items[][quantity]" class="form-control qty" value="1"></td>
            <td><input type="number" name="items[][price]" class="form-control price" readonly></td>
            <td><input type="number" name="items[][subtotal]" class="form-control subtotal" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm remove-item">X</button></td>
        </tr>`;
    }

    function updateSubtotal(row) {
        let qty = parseInt(row.find('.qty').val());
        let price = parseFloat(row.find('.price').val());
        row.find('.subtotal').val((qty * price).toFixed(2));
    }

    $('#add-item').click(function() {
        $('#product-table tbody').append(renderRow());
    });

    $(document).on('change', '.product-select', function() {
        let price = $(this).find(':selected').data('price');
        let row = $(this).closest('tr');
        row.find('.price').val(price);
        updateSubtotal(row);
    });

    $(document).on('input', '.qty', function() {
        let row = $(this).closest('tr');
        updateSubtotal(row);
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
    });
</script>
@endsection
