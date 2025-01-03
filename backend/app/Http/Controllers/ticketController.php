<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    //

    public function CreateTicket(Request $request){

        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'contact_email' => 'required|email|max:255',
                'priority' => 'required|string|max:50',
                'organization' => 'required|string|max:255',
                'vessel' => 'required|string|max:255',
                'service_line' => 'required|string|max:255',
                'assign_to' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                // 'user_id' => 'sometimes|string|exists:users,id', // Uncomment if user_id is used
            ]);

            // Create a new ticket record
            $ticket = Tickets::create($validatedData);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully.',
                'data' => $ticket
            ], 201);
        } catch (ValidationException $e) {
            // Return a validation error response
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Return a general error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the ticket.',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function GetOneTicket($id){
        try {
            // Find the ticket by ID
            $ticket = Tickets::findOrFail($id);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Ticket retrieved successfully.',
                'data' => $ticket
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if the ticket is not found
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found.',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function GetTicket(Request $request){
        try {
            // Retrieve query parameters
            $filterKey = $request->input('filterKey');
            $filterValue = $request->input('filterValue');
            $currentPage = $request->input('currentPage', 1); // Default to 1 if not provided
            $itemPerPage = $request->input('itemPerPage', 10); // Default to 10
            $field = $request->input('field', 'id'); // Default sort field
            $byDescending = $request->boolean('byDescending', false); // Default ascending

            // Build the query
            $query = Tickets::query();

            // Apply filter if provided
            if ($filterKey && $filterValue) {
                $query->where($filterKey, 'like', '%' . $filterValue . '%');
            }

            // Apply sorting
            $orderBy = $byDescending ? 'desc' : 'asc';
            $query->orderBy($field, $orderBy);

            // Get total records count before pagination
            $totalRecords = $query->count();

            // Paginate results
            $tickets = $query->paginate($itemPerPage, ['*'], 'page', $currentPage);

            // Calculate total pages
            $totalPages = ceil($totalRecords / $itemPerPage);

            // Return the paginated results with additional metadata
            return response()->json([
                'success' => true,
                'message' => 'Tickets retrieved successfully.',
                'data' => $tickets->items(), // Paginated items
                'currentPage' => $tickets->currentPage(),
                'totalPage' => $totalPages,
                'totalColumn' => $totalRecords, // Total rows before pagination
                'itemPerPage' => $tickets->perPage()
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving tickets.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function UpdateTicket(Request $request, $id){
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'contact_email' => 'required|email|max:255',
                'priority' => 'required|string|max:50',
                'organization' => 'required|string|max:255',
                'vessel' => 'required|string|max:255',
                'service_line' => 'required|string|max:255',
                'assign_to' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'category' => 'required|string|max:255',
            ]);

            // Find the ticket by ID
            $ticket = Tickets::findOrFail($id);

            // Update the ticket with the validated data
            $ticket->update($validatedData);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Ticket updated successfully.',
                'data' => $ticket
            ], 200);
        } catch (ValidationException $e) {
            // Return a validation error response
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Return a general error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the ticket.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function DeleteTicket($id){
        try {
            // Find the ticket by ID
            $ticket = Tickets::findOrFail($id);

            // Delete the ticket
            $ticket->delete();

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => 'Ticket deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            // Return an error response if the ticket is not found or other error occurs
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the ticket.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
