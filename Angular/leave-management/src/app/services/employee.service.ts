
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';
import { Employee } from '../models/employee.model';

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
  constructor(private apiService: ApiService) {}

  getAllEmployees(): Observable<Employee[]> {
    return this.apiService.get<Employee[]>('/employees');
  }

  getEmployeeById(id: number): Observable<Employee> {
    return this.apiService.get<Employee>(`/employees/${id}`);
  }

  createEmployee(employee: Employee): Observable<any> {
    return this.apiService.post('/employees', employee);
  }

  updateEmployee(id: number, employee: Employee): Observable<any> {
    return this.apiService.put(`/employees/${id}`, employee);
  }

  deleteEmployee(id: number): Observable<any> {
    return this.apiService.delete(`/employees/${id}`);
  }

  login(username: string, password: string): Observable<any> {
    return this.apiService.post('/auth/login', { username, password });
  }

  resetPassword(id: number, currentPassword: string, newPassword: string): Observable<any> {
    return this.apiService.post(`/employees/${id}/reset-password`, {
      currentPassword,
      newPassword
    });
  }
}
