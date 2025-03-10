<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\ServiceRequest;
use App\Models\Reservation;
use App\Models\reservation_Item_Service;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function orderService(Request $request)
    {
        $validated = $request->validated();

        $reservation = Reservation::find($validated['reservation_items_id']);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $service = Service::find($validated['services_id']);
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }

        $subtotal_services = $service->price * $validated['quantity'];

        $serviceRequest = reservation_Item_Service::create([
            'services_id' => $validated['services_id'],
            'reservation_items_id' => $validated['reservation_items_id'],
            'service_price' => $service->price,
            'quantity' => $validated['quantity'],
            'subtotal_services' => $subtotal_services,
        ]);

        return response()->json(['message' => 'Service requested successfully', 'service_request' => $serviceRequest], 200);
    }


    public function cancelServiceRequest(Request $request)
    {
        $validated = $request->validated();

        $serviceRequest = reservation_Item_Service::where('reservation_items_id', $validated['reservation_items_id'])
            ->where('services_id', $validated['services_id'])
            ->first();

        if (!$serviceRequest) {
            return response()->json(['message' => 'Service request not found'], 404);
        }

        $serviceRequest->delete();

        return response()->json(['message' => 'Service request cancelled successfully'], 200);
    }

    public function showServiceRequests(Request $request)
    {
        $validated = $request->validated();

        $serviceRequests = reservation_Item_Service::where('reservation_items_id', $validated['reservation_items_id'])
            ->get();

        if ($serviceRequests->isEmpty()) {
            return response()->json(['message' => 'No service requests found'], 404);
        }

        return response()->json(['service_requests' => $serviceRequests], 200);
    }


    public function index()
    {
        $services = Service::all();
        return response()->json(['message' => 'All Services', 'services' => $services], 200);
    }


    public function searchservices(SearchRequest $request)
    {
        $query = Service::query();

        if ($request->filled('price')) {
            $query->where('price', '=', $request->price);
        }

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('priceFrom') && $request->filled('priceTo')) {
            $query->whereBetween('price', [$request->priceFrom, $request->priceTo]);
        } elseif ($request->filled('priceFrom')) {
            $query->where('price', '>=', $request->priceFrom);
        } elseif ($request->filled('priceTo')) {
            $query->where('price', '<=', $request->priceTo);
        }

        if ($request->filled('sortby') && $request->filled('sortorder')) {
            $allowedSortFields = ['price', 'created_at', 'name']; //  حماية من SQL Injection
            $sortField = in_array($request->sortby, $allowedSortFields) ? $request->sortby : 'created_at';
            $sortOrder = in_array(strtolower($request->sortorder), ['asc', 'desc']) ? $request->sortorder : 'asc';

            $query->orderBy($sortField, $sortOrder);
        }

        $filteredservices = clone $query;


        $service = $filteredservices->paginate(1);

        if ($service->isEmpty()) {
            return response()->json([
                'status' => '0',
                'message' => 'No services found matching your criteria.',
                'data' => [],
            ], 404);
        }

        return response()->json([
            'status' => '1',
            'message' => 'success',
            'data' => $filteredservices->paginate(5),
            'allAvailableServices' => Service::paginate(5),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $validated =  $request->validated();
        $services =  Service::create($validated);
        return response()->json(['message' => 'Successfully added to Services', 'services' => $services], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $services = Service::find($id);

        if (!$services) {
            return response()->json([
                'message' => 'service not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Service Show successfully.',
            'Service_Details' => $services,
        ]);
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
    public function update(ServiceRequest $request, string $id)
    {
        $services = Service::findOrFail($id);

        $vaildated = $request->validated();
        $services->update($vaildated);

        return response()->json($services, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Service Deleted Successfully',
        ], 200);
    }
}
