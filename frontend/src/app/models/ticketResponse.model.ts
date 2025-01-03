// models/ApiRequest.ts

export interface Ticket {
  id: string
  title: string
  description: string
  contact_email: string
  priority: string
  organization: string
  vessel: string
  service_line: string
  assign_to: string
  status: string
  category: string
  created_at: string;
  updated_at: string;
  deleted_at: string | null;
}

export interface getTicketResponse {
  success: boolean;
  message: string;
  data: Ticket[];
  currentPage: number;
  totalPage: number;
  totalColumn: number;
  itemPerPage: number;
}



export interface TicketData {
  id: string
  title: string
  description: string
  contact_email: string
  priority: string
  organization: string
  vessel: string
  service_line: string
  assign_to: string
  status: string
  category: string
  created_at: string;
  updated_at: string;
}