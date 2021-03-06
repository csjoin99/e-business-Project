<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Factura de compra</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title" style="max-width: 150px">
                                @if ($settings->logo)
                                <h2 style="margin: 20px 0px">{{$settings->name}}</h2>
                                {{-- <img src="{{$settings->logo}}" style="width: 100%; max-width: 300px" /> --}}
                                {{-- <img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 300px" /> --}}
                                @else
                                <h2 style="margin: 20px 0px">{{$settings->name}}</h2>
                                @endif
                            </td>
                            <td>
                                <span style="white-space: nowrap">Factura #: {{$order->code}}</span>
                                <br />
                                <span style="white-space: nowrap">Fecha:
                                    {{Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d/m/Y')}}</span><br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            {{-- <td>
									Sparksuite, Inc.<br />
									12345 Sunny Road<br />
									Sunnyville, CA 12345
								</td>

								<td>
									Acme Corp.<br />
									John Doe<br />
									john@example.com
								</td> --}}
                            <td>
                                {{$order->user ? $order->user->name .' '.$order->user->lastname : $order->client}}<br />
                                {{$order->user ? $order->user->email : ''}}
                            </td>

                            <td>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Item</td>
                <td style="text-align: left">Cantidad</td>
                <td>Precio</td>
            </tr>
            @foreach ($order->product as $product)
            <tr class="item">
                <td>{{$product->name}}</td>
                <td style="text-align: left">{{$product->pivot->quantity}}</td>
                <td>S/. {{$product->pivot->price}}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td></td>
                <td colspan="2">Subtotal: S/. {{number_format($order->subtotal,2)}}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td colspan="2">Precio de env??o: S/. {{number_format($order->shipment_price,2)}}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td colspan="2">Descuento: S/. {{number_format($order->discount,2)}}</td>
            </tr>
            <tr class="total">
                <td></td>
                <td colspan="2">Total: S/. {{number_format($order->total,2)}}</td>
            </tr>
        </table>
    </div>
</body>

</html>