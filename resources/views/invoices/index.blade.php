@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Facturas</h1>
  <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Crear Factura</a>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($invoices as $invoice)
      <tr>
      <td>{{ $invoice->id }}</td>
      <td>{{ $invoice->client->name }}</td>
      <td>${{ number_format($invoice->total, 2) }}</td>
      <td>{{ ucfirst($invoice->status) }}</td>
      <td>
        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info">Ver</a>
      </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection