// models/ApiResponse.ts
export interface getTicketRequest {
  filterKey: string;
  filterValue: string;
  currentPage: number;
  itemPerPage: number;
  field: string;
  byDescending: boolean;
}

export interface TicketRequest {
  title: string;
  description: string;
  contact_email: string;
  priority: string;
  organization: string;
  vessel: string;
  service_line: string;
  assign_to: string;
  status:string;
  category: string;
}