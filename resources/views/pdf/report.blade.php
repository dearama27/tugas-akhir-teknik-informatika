<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Delivery</title>

    <style>
        table {
            font-size: 10px;
            width: 100%;
            border-collapse: collapse;

        }

        table td, table tr th {
            border: 1px solid gray;
            padding: 4; 
            margin: 0;
        }
    </style>
</head>

<body>
    <h3 style="text-align: center">Laporan Pengiriman</h3>
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th rowspan="2" style="vertical-align: middle; ">#</th>
                <th style="vertical-align: middle;" rowspan="2">Code</th>
                <th style="vertical-align: middle; " rowspan="2">Date Delivery</th>
                <th style="vertical-align: middle; " rowspan="2">Driver</th>
                <th style="vertical-align: middle; width: 150px" rowspan="2">Penganggung Jawab</th>
                <th style="vertical-align: middle;" rowspan="2">Ttl Price</th>
                <th style="vertical-align: middle; " rowspan="2">Ttl Qty</th>
                <th style="vertical-align: middle; " rowspan="2">Ttl Order</th>
                <th style="vertical-align: middle;" colspan="2">Actual</th>
                <th style="vertical-align: middle;" colspan="3">Status Order</th>
            </tr>
            <tr>
                <th style="width: 40px">Qty</th>
                <th style="width: 40px">Total</th>
                <th style="width: 40px">Belum</th>
                <th style="width: 40px">Terkirim</th>
                <th style="width: 40px">Batal</th>
            </tr>
        </thead>
        @if (!count($results))
        <tr>
            <td colspan="8" class="text-center">@lang('general.not_found')</td>
        </tr>
        @endif
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($results as $item)

            <tr>
                <td>{{ $no }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->date_delivery }}</td>
                <td>{{ $item->user_driver->name }}</td>
                <td>{{ $item->dc->name }}</td>
                <td>{{ $item->ttl_price }}</td>
                <td>{{ $item->ttl_qty }}</td>
                <td>{{ $item->detail->count() }}</td>

                <td>{{ $item->total_actual($item->detail)['qty'] }}</td>
                <td>{{ $item->total_actual($item->detail)['price'] }}</td>
                <td>{{ $item->status($item->detail->toArray())['belum'] }}</td>
                <td>{{ $item->status($item->detail->toArray())['terkirim'] }}</td>
                <td>{{ $item->status($item->detail->toArray())['batal'] }}</td>
            </tr>
            @php
            $no++;
            @endphp
            @endforeach

        </tbody>
    </table>
</body>

</html>