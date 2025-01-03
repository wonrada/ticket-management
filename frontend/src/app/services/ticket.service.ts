// services/apiService.ts
import axios from 'axios';
import type { getTicketResponse } from '../models/ticketResponse.model';
import type { getTicketRequest, TicketRequest } from '../models/ticketRequest.model';
import type { TicketResponse } from '../models/response.model';

const apiClient = axios.create({
  baseURL: 'http://localhost:8000/api', // Replace with your API base URL
  headers: {
    'Content-Type': 'application/json',
  },
});

export const getTickets = async (params: getTicketRequest): Promise<getTicketResponse> => {
  try {
    const response = await apiClient.get('/tickets', {
      params: {
        filterKey: params.filterKey,
        filterValue: params.filterValue,
        currentPage: params.currentPage,
        itemPerPage: params.itemPerPage,
        field: params.field,
        byDescending: params.byDescending,
      },
    });
    return response.data;
  } catch (error) {
    console.error('Error fetching tickets:', error);
    throw error;
  }
};

export const getOneTickets = async (ticketId: string): Promise<TicketResponse> => {
  try {
    const response = await apiClient.get('/tickets/'+ticketId);
    return response.data;
  } catch (error) {
    console.error('Error fetching tickets:', error);
    throw error;
  }
};

export const createTicket = async (ticket: TicketRequest): Promise<TicketResponse> => {
  try {
    const response = await apiClient.post('/tickets', ticket);
    return response.data;
  } catch (error) {
    console.error('Error create tickets:', error);
    throw error;
  }
};

export const updateTicket = async (ticketId:string,ticket: TicketRequest): Promise<TicketResponse> => {
  try {
    const response = await apiClient.put('/tickets/'+ticketId, ticket);
    return response.data;
  } catch (error) {
    console.error('Error update tickets:', error);
    throw error;
  }
};

export const deleteTicket = async (ticketId: string): Promise<TicketResponse> => {
  try {
    const response = await apiClient.delete(`/tickets/${ticketId}`);
    return response.data;
  } catch (error) {
    console.error('Error delete tickets:', error);
    throw error;
  }
};