@extends('user.app')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Cart</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <h2 class="display-5">Detail Pesanan Anda</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <table>
                                        <tr>
                                            <th>No Invoice</th>
                                            <td>:</td>
                                            <td>{{ $order->invoice }}</td>
                                        </tr>
                                        <tr>
                                            <th>No Resi</th>
                                            <td>:</td>
                                            <td>{{ $order->no_resi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status Pesanan</th>
                                            <td>:</td>
                                            <td>{{ $order->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Metode Pembayaran</th>
                                            <td>:</td>
                                            <td>
                                                @if ($order->metode_pembayaran == 'trf')
                                                    Transfer Bank
                                                @else
                                                    COD
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Pembayaran</th>
                                            <td>:</td>
                                            <td>Rp. {{ number_format($order->subtotal + $order->biaya_cod, 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4 text-right">
                                    @if ($order->status_order_id == 4)
                                        <a href="{{ route('user.order.pesananditerima', ['id' => $order->id]) }}"
                                            onclik="return confirm('Yakin ingin melanjutkan ?')"
                                            class="btn btn-primary">Pesanan Di Terima</a><br>
                                        <small>Jika pesanan belum datang harap jangan tekan tombol ini</small>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Gambar</th>
                                                <th class="product-name">Nama Produk</th>
                                                <th class="product-price">Jumlah</th>
                                                <th class="product-quantity" width="20%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail as $o)
                                                <tr>
                                                    <td><img src="{{ asset('storage/' . $o->image) }}" alt=""
                                                            srcset="" width="50"></td>
                                                    <td>{{ $o->nama_produk }}</td>
                                                    <td>{{ $o->qty }}</td>
                                                    <td>{{ $o->qty * $o->price }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            @if($order->status_order_id == 5)
                            <form action="{{ route('user.order.retur', ['order' => $order->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h5>Opsi Retur</h5>
                                <div class="form-group">
                                    <label for="">Upload Bukti Retur</label>
                                    <input type="file" name="bukti_retur" id="" class="form-control" accept="image/*"
                                        required>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Ajukan Retur</button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
