
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpService } from './http.service';
import { Department } from '../models/department.model';

@Injectable({
  providedIn: 'root'
})
export class DepartmentService {

  constructor(private httpService: HttpService) { }

  getDepartments(): Observable<Department[]> {
    return this.httpService.get<Department[]>('/departments/read.php');
  }

  getDepartment(id: number): Observable<Department> {
    return this.httpService.get<Department>(`/departments/read.php?id=${id}`);
  }

  createDepartment(department: Department): Observable<any> {
    return this.httpService.post('/departments/create.php', department);
  }

  updateDepartment(id: number, department: Department): Observable<any> {
    return this.httpService.put(`/departments/update.php?id=${id}`, department);
  }

  deleteDepartment(id: number): Observable<any> {
    return this.httpService.delete(`/departments/delete.php?id=${id}`);
  }
}
