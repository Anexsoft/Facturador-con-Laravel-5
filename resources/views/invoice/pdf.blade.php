<html>
    <head>
        <style>
            .header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}

            .client-detail{background:#ddd;padding:10px;}
            .client-detail th{text-align:left;}

            .items{border-spacing:0;}
            .items thead{background:#ddd;}
            .items tbody{background:#eee;}
            .items tfoot{background:#ddd;}
            .items th{padding:10px;}
            .items td{padding:10px;}

            h1 small{display:block;font-size:16px;color:#888;}

            table{width:100%;}
            .text-right{text-align:right;}
        </style>
    </head>
    <body>

    <div class="header">
        <h1>
            Comprobante # {{ str_pad ($model->id, 7, '0', STR_PAD_LEFT) }}
            <small>
                Emitido el {{ $model->created_at }}
            </small>
        </h1>
    </div>
    <table class="client-detail">
        <tr>
            <th style="width:100px;">
                Cliente
            </th>
            <td>{{ $model->client->name }}</td>
        </tr>
        <tr>
            <th>Ruc</th>
            <td>{{ $model->client->ruc }}</td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td>{{ $model->client->address }}</td>
        </tr>
    </table>

    <hr />

    <table class="items">
        <thead>
            <tr>
                <th class="text-left">Producto</th>
                <th class="text-right" style="width:100px;">Cantidad</th>
                <th class="text-right" style="width:100px;">P.U</th>
                <th class="text-right" style="width:100px;">Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($model->detail as $d)
            <tr>
                <td>{{$d->product->name}}</td>
                <td class="text-right">{{$d->quantity}}</td>
                <td class="text-right">$ {{number_format($d->unitPrice, 2)}}</td>
                <td class="text-right">$ {{number_format($d->total, 2)}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" class="text-right"><b>IVA</b></td>
            <td class="text-right">$ {{ number_format($model->iva, 2) }}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><b>Sub Total</b></td>
            <td class="text-right">$ {{ number_format($model->subTotal, 2) }}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><b>Total</b></td>
            <td class="text-right">$ {{ number_format($model->total, 2) }}</td>
        </tr>
        </tfoot>
    </table>
    </body>
</html>