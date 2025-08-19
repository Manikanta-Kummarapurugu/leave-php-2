
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';
import { Leave } from '../models/leave.model';

@Injectable({
  providedIn: 'root'
})
export class LeaveService {
  constructor(private apiService: ApiService) {}

  getAllLeaves(): Observable<Leave[]> {
    return this.apiService.get<Leave[]>('/leaves');
  }

  getLeaveById(id: number): Observable<Leave> {
    return this.apiService.get<Leave>(`/leaves/${id}`);
  }

  createLeave(leave: Leave): Observable<any> {
    return this.apiService.post('/leaves', leave);
  }

  updateLeave(id: number, leave: Leave): Observable<any> {
    return this.apiService.put(`/leaves/${id}`, leave);
  }

  deleteLeave(id: number): Observable<any> {
    return this.apiService.delete(`/leaves/${id}`);
  }

  getLeavesByEmployee(employeeId: string): Observable<Leave[]> {
    return this.apiService.get<Leave[]>(`/leaves/employee/${employeeId}`);
  }

  getLeavesByStatus(status: string): Observable<Leave[]> {
    return this.apiService.get<Leave[]>(`/leaves/status/${status}`);
  }
}
