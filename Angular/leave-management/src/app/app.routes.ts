
import { Routes } from '@angular/router';
import { LoginComponent } from './components/login/login.component';
import { DashboardComponent } from './components/dashboard/dashboard.component';
import { LeaveListComponent } from './components/leave-list/leave-list.component';
import { EmployeeListComponent } from './components/employee-list/employee-list.component';
import { CompanyListComponent } from './components/company-list/company-list.component';
import { CompanyAddComponent } from './components/company-add/company-add.component';
import { DepartmentListComponent } from './components/department-list/department-list.component';
import { LeaveTypeListComponent } from './components/leave-type-list/leave-type-list.component';

export const routes: Routes = [
  { path: '', redirectTo: '/login', pathMatch: 'full' },
  { path: 'login', component: LoginComponent },
  { path: 'dashboard', component: DashboardComponent },
  { path: 'leaves', component: LeaveListComponent },
  { path: 'employees', component: EmployeeListComponent },
  { path: 'companies', component: CompanyListComponent },
  { path: 'companies/add', component: CompanyAddComponent },
  { path: 'companies/edit/:id', component: CompanyAddComponent },
  { path: 'departments', component: DepartmentListComponent },
  { path: 'leave-types', component: LeaveTypeListComponent },
  { path: '**', redirectTo: '/login' }
];
