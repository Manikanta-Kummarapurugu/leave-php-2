
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpService } from './http.service';
import { Employee } from '../models/employee.model';

@Injectable({
  providedIn: 'root'
})
export class EmployeeService {
  constructor(private httpService: HttpService) {}

  getAllEmployees(): Observable<Employee[]> {
    return this.httpService.get<Employee[]>('/employees');
  }

  getEmployeeById(id: string): Observable<Employee> {
    return this.httpService.get<Employee>(`/employees/${id}`);
  }

  createEmployee(employee: Employee): Observable<any> {
    return this.httpService.post('/employees', employee);
  }

  updateEmployee(id: string, employee: Employee): Observable<any> {
    return this.httpService.put(`/employees/${id}`, employee);
  }

  deleteEmployee(id: string): Observable<any> {
    return this.httpService.delete(`/employees/${id}`);
  }

  login(username: string, password: string): Observable<any> {
    return this.httpService.post('/auth/login', { username, password });
  }

  resetPassword(id: string, currentPassword: string, newPassword: string): Observable<any> {
    return this.httpService.post(`/employees/${id}/reset-password`, {
      currentPassword,
      newPassword
    });
  }
}
