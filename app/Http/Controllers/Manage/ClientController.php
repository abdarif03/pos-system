<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of clients
     */
    public function index(Request $request)
    {
        try {
            $query = Client::query();

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Filter by package type
            if ($request->filled('package_type')) {
                $query->where('package_type', $request->package_type);
            }

            // Search by name, email, or company name
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('company_name', 'like', "%{$search}%");
                });
            }

            // Eager load payments for better performance
            $clients = $query->with(['payments' => function($q) {
                $q->latest()->take(5); // Only load latest 5 payments
            }])->latest()->paginate(15);

            return view('manage.clients.index', compact('clients'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading clients: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new client
     */
    public function create()
    {
        return view('manage.clients.create');
    }

    /**
     * Store a newly created client
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:clients,email',
                'phone' => 'required|string|max:20',
                'company_name' => 'required|string|max:255',
                'package_type' => 'required|in:basic,premium,enterprise',
                'status' => 'required|in:active,inactive',
                'registration_date' => 'required|date',
                'expiry_date' => 'required|date|after:registration_date',
                'notes' => 'nullable|string|max:1000',
            ]);

            DB::beginTransaction();
            
            $client = Client::create($validated);
            
            DB::commit();

            return redirect()->route('manage.clients.index')
                ->with('success', 'Client berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error creating client: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified client
     */
    public function show(Client $client)
    {
        try {
            // Eager load payments with pagination for better performance
            $client->load(['payments' => function($q) {
                $q->latest()->take(10);
            }]);

            return view('manage.clients.show', compact('client'));
        } catch (\Exception $e) {
            return redirect()->route('manage.clients.index')
                ->with('error', 'Error loading client details: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified client
     */
    public function edit(Client $client)
    {
        try {
            return view('manage.clients.edit', compact('client'));
        } catch (\Exception $e) {
            return redirect()->route('manage.clients.index')
                ->with('error', 'Error loading client for editing: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified client
     */
    public function update(Request $request, Client $client)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('clients')->ignore($client->id),
                ],
                'phone' => 'required|string|max:20',
                'company_name' => 'required|string|max:255',
                'package_type' => 'required|in:basic,premium,enterprise',
                'status' => 'required|in:active,inactive',
                'registration_date' => 'required|date',
                'expiry_date' => 'required|date|after:registration_date',
                'notes' => 'nullable|string|max:1000',
            ]);

            DB::beginTransaction();
            
            $client->update($validated);
            
            DB::commit();

            return redirect()->route('manage.clients.index')
                ->with('success', 'Client berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error updating client: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified client
     */
    public function destroy(Client $client)
    {
        try {
            DB::beginTransaction();
            
            // Check if client has payments
            if ($client->payments()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Cannot delete client with existing payments. Please delete payments first.');
            }
            
            $client->delete();
            
            DB::commit();

            return redirect()->route('manage.clients.index')
                ->with('success', 'Client berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deleting client: ' . $e->getMessage());
        }
    }

    /**
     * Activate the specified client
     */
    public function activate(Client $client)
    {
        try {
            DB::beginTransaction();
            
            $client->update(['status' => 'active']);
            
            DB::commit();

            return redirect()->back()->with('success', 'Client berhasil diaktifkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error activating client: ' . $e->getMessage());
        }
    }

    /**
     * Deactivate the specified client
     */
    public function deactivate(Client $client)
    {
        try {
            DB::beginTransaction();
            
            $client->update(['status' => 'inactive']);
            
            DB::commit();

            return redirect()->back()->with('success', 'Client berhasil dinonaktifkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error deactivating client: ' . $e->getMessage());
        }
    }
} 