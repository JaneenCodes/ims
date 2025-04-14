@forelse ($products as $product)
    <tr class="hover-bg-light product-list">
        <td>{{ $product->SKU }}</td>
        <td>{{ $product->name }}</td>
        <td>₱ {{ $product->price }}</td>
        <td>{{ $product->quantity }}</td>
        <td>{{ $product->supplier }}</td>

        @auth
            @if(auth()->user()->role == 'admin')
                <td class="text-center">
                    <a href="javascript:void(0)" class="btn btn-success btn-sm rounded-start-pill">+RSK</a>
                    <a href="javascript:void(0)" class="btn btn-warning btn-sm rounded-end-pill">-DED</a>
                    <a href="javascript:void(0)"
                       class="edit-btn btn btn-primary btn-sm rounded-pill"
                       data-id="{{ $product->id }}"
                       data-name="{{ $product->name }}"
                       data-price="{{ $product->price }}"
                       data-quantity="{{ $product->quantity }}"
                       data-supplier="{{ $product->supplier }}">
                       Edit
                    </a>
                    <a href="javascript:void(0)"
                       class="delete-btn btn btn-danger btn-sm rounded-pill"
                       data-url="{{ route('product.destroy', $product->id) }}">
                       Delete
                    </a>
                </td>
            @endif
        @endauth
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center text-muted">No Records Found</td>
    </tr>
@endforelse
