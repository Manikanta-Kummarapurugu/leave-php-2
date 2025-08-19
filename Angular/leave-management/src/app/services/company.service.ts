
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpService } from './http.service';
import { Company } from '../models/company.model';

@Injectable({
  providedIn: 'root'
})
export class CompanyService {
  constructor(private httpService: HttpService) {}

  getAllCompanies(): Observable<Company[]> {
    return this.httpService.get<Company[]>('/companies');
  }

  getCompanyById(id: number): Observable<Company> {
    return this.httpService.get<Company>(`/companies/${id}`);
  }

  createCompany(company: Company): Observable<any> {
    return this.httpService.post('/companies', company);
  }

  updateCompany(id: number, company: Company): Observable<any> {
    return this.httpService.put(`/companies/${id}`, company);
  }

  deleteCompany(id: number): Observable<any> {
    return this.httpService.delete(`/companies/${id}`);
  }
}
