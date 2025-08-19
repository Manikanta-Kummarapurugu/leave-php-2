
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpService } from './http.service';
import { Leave } from '../models/leave.model';

@Injectable({
  providedIn: 'root'
})
export class LeaveService {
  constructor(private httpService: HttpService) {}

  getAllLeaves(): Observable<Leave[]> {
    return this.httpService.get<Leave[]>('/leaves');
  }

  getLeaveById(id: number): Observable<Leave> {
    return this.httpService.get<Leave>(`/leaves/${id}`);
  }

  createLeave(leave: Leave): Observable<any> {
    return this.httpService.post('/leaves', leave);
  }

  updateLeave(id: number, leave: Leave): Observable<any> {
    return this.httpService.put(`/leaves/${id}`, leave);
  }

  deleteLeave(id: number): Observable<any> {
    return this.httpService.delete(`/leaves/${id}`);
  }

  getLeavesByEmployee(employeeId: string): Observable<Leave[]> {
    return this.httpService.get<Leave[]>(`/leaves/employee/${employeeId}`);
  }

  getLeavesByStatus(status: string): Observable<Leave[]> {
    return this.httpService.get<Leave[]>(`/leaves/status/${status}`);
  }

  approveLeave(id: number, remarks: string): Observable<any> {
    return this.httpService.put(`/leaves/${id}/approve`, { remarks });
  }

  rejectLeave(id: number, remarks: string): Observable<any> {
    return this.httpService.put(`/leaves/${id}/reject`, { remarks });
  }
}
