<?php

use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("tickets",[TicketController::class,'CreateTicket']);
Route::get("tickets",[TicketController::class,'GetTicket']);
Route::get("tickets/{id}",[TicketController::class,'GetOneTicket']);
Route::put("tickets/{id}",[TicketController::class,'UpdateTicket']);
Route::delete("tickets/{id}",[TicketController::class,'DeleteTicket']);
Route::put("delTickets/{id}",[TicketController::class,'DeleteTicket']);

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello, API!']);
});
