@extends('layouts.admin')

@section('content')
<h3>Produk</h3>

<table class="table">
    <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <td>
                <img src="{{ $product->image_url }}" width="60">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->formatted_price }}</td>
            <td>
                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-info btn-sm">Show</a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">Tidak ada produk</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}
@endsection
