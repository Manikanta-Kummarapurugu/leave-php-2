
import { Routes } from '@angular/router';
import { LeaveListComponent } from './components/leave-list/leave-list.component';

export const routes: Routes = [
  { path: '', redirectTo: '/leaves', pathMatch: 'full' },
  { path: 'leaves', component: LeaveListComponent },
  { path: 'dashboard', component: LeaveListComponent }, // Temporary
  { path: 'employees', component: LeaveListComponent }, // Temporary
  { path: 'companies', component: LeaveListComponent }, // Temporary
  { path: 'departments', component: LeaveListComponent }, // Temporary
  { path: 'leave-types', component: LeaveListComponent }, // Temporary
];
