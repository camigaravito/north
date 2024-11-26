<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Factura Electrónica</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
    }

    .container {
      width: 80%;
      margin: 0 auto;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header h1 {
      font-size: 2.5em;
      margin: 0;
    }

    .invoice-details {
      margin-bottom: 20px;
    }

    .invoice-details th,
    .invoice-details td {
      padding: 8px;
      text-align: left;
    }

    .invoice-details {
      width: 100%;
      border-collapse: collapse;
    }

    .invoice-details th {
      background-color: #f2f2f2;
    }

    .total {
      text-align: right;
      font-size: 1.2em;
      font-weight: bold;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Factura Electrónica</h1>
      <p>Gracias por tu compra. A continuación se presentan los detalles de tu factura.</p>
    </div>

    <div class="invoice-details">
      <table>
        <tr>
          <th>Cliente</th>
          <td>{{ $invoice->client->name }}</td>
        </tr>
        <tr>
          <th>NIT</th>
          <td>{{ $invoice->client->nit }}</td>
        </tr>
        <tr>
          <th>Correo Electrónico</th>
          <td>{{ $invoice->client->email }}</td>
        </tr>
        <tr>
          <th>Dirección</th>
          <td>{{ $invoice->client->address }}</td>
        </tr>
        <tr>
          <th>Teléfono</th>
          <td>{{ $invoice->client->phone }}</td>
        </tr>
        <tr>
          <th>Fecha de Factura</th>
          <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
        </tr>
        <tr>
          <th>Factura Número</th>
          <td>{{ $invoice->invoice_number }}</td>
        </tr>
      </table>
    </div>

    <h2>Detalles de la Factura</h2>
    <table class="invoice-details">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($invoice->items as $item)
      <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->product->price, 2) }} COP</td>
        <td>{{ number_format($item->subtotal, 2) }} COP</td>
      </tr>
    @endforeach
      </tbody>
    </table>

    <div class="total">
      <p><strong>Total: {{ number_format($invoice->total, 2) }} COP</strong></p>
    </div>

    <p>Si tienes alguna duda, no dudes en ponerte en contacto con nosotros.</p>
  </div>
</body>

</html>