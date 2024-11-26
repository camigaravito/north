@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Detalle de la Factura</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <p><strong>Número de Factura:</strong> {{ $invoice->invoice_number }}</p>
  <p><strong>Cliente:</strong> {{ $invoice->client->name }}</p>
  <p><strong>Total:</strong> ${{ number_format($invoice->total, 2) }}</p>
  <p><strong>Estado:</strong> {{ ucfirst($invoice->status) }}</p>

  <h3>Productos</h3>
  <table class="table">
    <thead>
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoice->items as $item)
      <tr>
      <td>{{ $item->product->name }}</td>
      <td>{{ $item->quantity }}</td>
      <td>${{ number_format($item->subtotal, 2) }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <div class="mt-3">
    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('invoices.sendEmail', $invoice->id) }}" class="btn btn-primary">Enviar por Correo</a>
  </div>
</div>
@endsection