
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';
import { Department } from '../models/department.model';

@Injectable({
  providedIn: 'root'
})
export class DepartmentService {
  constructor(private apiService: ApiService) {}

  getAllDepartments(): Observable<Department[]> {
    return this.apiService.get<Department[]>('/departments');
  }

  getDepartmentById(id: number): Observable<Department> {
    return this.apiService.get<Department>(`/departments/${id}`);
  }

  createDepartment(department: Department): Observable<any> {
    return this.apiService.post('/departments', department);
  }

  updateDepartment(id: number, department: Department): Observable<any> {
    return this.apiService.put(`/departments/${id}`, department);
  }

  deleteDepartment(id: number): Observable<any> {
    return this.apiService.delete(`/departments/${id}`);
  }
}
