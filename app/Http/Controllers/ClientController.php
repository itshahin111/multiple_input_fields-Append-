<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('index', compact('clients'));
    }

    public function all()
    {
        $clients = Client::all();
        return view('all_clients', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inputs.*.first_name' => 'required|string|max:255',
            'inputs.*.last_name' => 'required|string|max:255',
            'inputs.*.email' => 'nullable|email|max:255|unique:clients,email',
            'inputs.*.phone' => 'nullable|string|max:15|unique:clients,phone',
            'inputs.*.address' => 'nullable|string|max:255',
        ]);

        foreach ($request->inputs as $input) {
            Client::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'address' => $input['address'],
            ]);
        }

        return redirect()->route('clients.index')->with('success', 'Clients added successfully!');
    }

    public function show(Client $client)
    {
        return view('show', compact('client'));
    }

    public function edit($id)
    {
        $client = Client::with('details')->findOrFail($id);
        return view('clients.edit', compact('client'));
    }
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'inputs.*.first_name' => 'required|string|max:255',
            'inputs.*.last_name' => 'required|string|max:255',
            'inputs.*.email' => 'nullable|email|max:255|unique:clients,email,' . $client->id,
            'inputs.*.phone' => 'nullable|string|max:15|unique:clients,phone,' . $client->id,
            'inputs.*.address' => 'nullable|string|max:255',
        ]);

        $client->update($request->only(['first_name', 'last_name', 'email', 'phone', 'address']));

        foreach ($request->inputs as $index => $input) {
            $client->details()->updateOrCreate(
                ['id' => $input['id'] ?? null], // Assuming there is an `id` field in details
                $input
            );
        }

        return redirect()->route('clients.show', $client->id)->with('success', 'Client updated successfully!');
    }

}
