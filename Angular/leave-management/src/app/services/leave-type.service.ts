
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';
import { LeaveType } from '../models/leave-type.model';

@Injectable({
  providedIn: 'root'
})
export class LeaveTypeService {
  constructor(private apiService: ApiService) {}

  getAllLeaveTypes(): Observable<LeaveType[]> {
    return this.apiService.get<LeaveType[]>('/leave-types');
  }

  getLeaveTypeById(id: number): Observable<LeaveType> {
    return this.apiService.get<LeaveType>(`/leave-types/${id}`);
  }

  createLeaveType(leaveType: LeaveType): Observable<any> {
    return this.apiService.post('/leave-types', leaveType);
  }

  updateLeaveType(id: number, leaveType: LeaveType): Observable<any> {
    return this.apiService.put(`/leave-types/${id}`, leaveType);
  }

  deleteLeaveType(id: number): Observable<any> {
    return this.apiService.delete(`/leave-types/${id}`);
  }
}
