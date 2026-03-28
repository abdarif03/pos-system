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
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="float-right">
                <label for="total-display">Total:</label>
                <input type="hidden" name="total" id="total" value="0">
                <input type="text" id="total-display" class="form-control" readonly>
            </div>
        </div>
    </div>    
    
    <button type="button" class="btn btn-secondary" id="add-item">+ Tambah Item</button>
    <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script type="text/javascript">
    
    let products = @json($products);

    /** Mirrors PHP format_idr(): Rp + ribuan "." (tanpa desimal). */
    function formatIdr(amount) {
        let n = Number(amount);
        if (isNaN(n)) return '';
        return 'Rp ' + Math.round(n).toLocaleString('id-ID');
    }

    function renderRow() {
        let options = '<option value="">Pilih Produk</option>';
        options += products.map(p => `<option value="${p.id}" data-price="${p.price}">${p.name}</option>`).join('');
        return `<tr>
            <td><select name="items[product_id][]" class="form-select product-select">${options}</select></td>
            <td><input type="number" name="items[quantity][]" class="form-control qty" value="1" min="1"></td>
            <td>
                <input type="hidden" name="items[price][]" class="price-value" value="">
                <input type="text" class="form-control price-display" readonly>
            </td>
            <td>
                <input type="hidden" name="items[subtotal][]" class="subtotal-value" value="">
                <input type="text" class="form-control subtotal-display" readonly>
            </td>
            <td><button type="button" class="btn btn-danger btn-sm remove-item">X</button></td>
        </tr>`;
    }

    function updateSubtotal(row) {
        let qty = parseInt(row.find('.qty').val(), 10) || 0;
        let rawPrice = row.find('.price-value').val();
        if (rawPrice === '' || rawPrice === undefined) {
            row.find('.subtotal-value').val('');
            row.find('.subtotal-display').val('');
            updateTotal();
            return;
        }
        let price = parseFloat(rawPrice) || 0;
        let subtotal = qty * price;
        row.find('.price-display').val(formatIdr(price));
        row.find('.subtotal-value').val(subtotal);
        row.find('.subtotal-display').val(formatIdr(subtotal));
        updateTotal();
    }

    function updateTotal() {
        let total = 0;
        $('#product-table .subtotal-value').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#total').val(total);
        $('#total-display').val(formatIdr(total));
    }

    $('#add-item').click(function() {
        $('#product-table tbody').append(renderRow());
    });

    $(document).on('change', '.product-select', function() {
        let row = $(this).closest('tr');
        let sel = $(this).find(':selected');
        if (!sel.val()) {
            row.find('.price-value').val('');
            row.find('.price-display').val('');
            row.find('.subtotal-value').val('');
            row.find('.subtotal-display').val('');
            updateTotal();
            return;
        }
        let price = sel.data('price');
        let p = parseFloat(price);
        row.find('.price-value').val(isNaN(p) ? '' : p);
        updateSubtotal(row);
    });

    $(document).on('input', '.qty', function() {
        let row = $(this).closest('tr');
        updateSubtotal(row);
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
        updateTotal();
    });
</script>
@endsection
