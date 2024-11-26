<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\Invoice;
use App\Models\Client;
use App\Models\Product;
use App\Models\InvoiceItem;

use App\Mail\InvoiceMail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('client')->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        return view('invoices.create', compact('clients', 'products'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|numeric|min:1',
        ]);

        $invoice_number = 'INV-' . strtoupper(Str::random(8));

        $invoice = Invoice::create([
            'client_id' => $request->client_id,
            'total' => 0,
            'invoice_number' => $invoice_number,
        ]);

        $total = 0;

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
            ]);
        }

        $invoice->update(['total' => $total]);

        return redirect()->route('invoices.index')->with('success', 'Factura creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('client', 'items.product');
        return view('invoices.show', compact('invoice'));
    }

    public function sendEmail(Invoice $invoice)
    {
        if (!$invoice->client->email) {
            return redirect()->route('invoices.show', $invoice->id)
                ->with('error', 'El cliente no tiene un correo electrónico registrado.');
        }

        try {
            Mail::to($invoice->client->email)->send(new InvoiceMail($invoice));
            return redirect()->route('invoices.show', $invoice->id)
                ->with('success', 'Factura enviada por correo correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('invoices.show', $invoice->id)
                ->with('error', 'Ocurrió un error al enviar la factura. Intente de nuevo. Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
