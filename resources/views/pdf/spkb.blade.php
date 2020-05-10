<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Delivery</title>

    <style>
        table.table-customer{
            font-size: 14px;
            width: 100%;
            border-spacing: 0;

        }

        table.table-customer td, table.table-customer tr th {
            border: 1px solid gray;
            padding: 4; 
            margin: 0;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center">Surat Perintah Keluar Barang (SPKB)</h3>
    <table>
        <tbody class="data-member">
          <tr>
            <td style="width: 150px">No. SPKB</td>
            <td>:</td>
            <td>{{$spkb->code}}</td>
          </tr>
          <tr>
            <td style="width: 150px">Tgl. Pengiriman</td>
            <td>:</td>
            <td>{{$spkb->date_delivery}}</td>
          </tr>
          <tr>
            <td style="width: 150px">Nama Driver</td>
            <td>:</td>
            <td>{{$spkb->user_driver->name}}</td>
          </tr>
          <tr>
            <td style="width: 150px">Total Pemesanan</td>
            <td>:</td>
            <td>Rp. {{number_format($spkb->ttl_price, '0', '0', '.')}}</td>
          </tr>
        </tbody>
      </table>

    <div style="width: 100%;">
        <div style="width: 50%; float: left;">
            <table class="table-customer">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spkb->detail as $i => $item)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$item->order->customer->name}}</td>
                            <td>{{$item->order->customer->address}}</td>
                            <td>{{$item->order->customer->mobile_phone}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="width: 50%; float: left; padding-left: 10px">
            <table class="table-customer">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Nama</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($spkb->detail as $i => $item)
                        @foreach ($item->order->detail as $order)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$order->product->name}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="clear:both"></div>
    </div>
</body>

</html>