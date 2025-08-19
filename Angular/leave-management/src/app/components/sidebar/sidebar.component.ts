
import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';

@Component({
  selector: 'app-sidebar',
  standalone: true,
  imports: [CommonModule, RouterModule],
  templateUrl: './sidebar.component.html',
  styleUrls: ['./sidebar.component.css']
})
export class SidebarComponent {
  menuItems = [
    { label: 'Dashboard', route: '/dashboard', icon: 'fa fa-fw fa-tachometer-alt' },
    { label: 'Leave Management', route: '/leaves', icon: 'fa fa-fw fa-calendar' },
    { label: 'Employees', route: '/employees', icon: 'fa fa-fw fa-users' },
    { label: 'Companies', route: '/companies', icon: 'fa fa-fw fa-building' },
    { label: 'Departments', route: '/departments', icon: 'fa fa-fw fa-sitemap' },
    { label: 'Leave Types', route: '/leave-types', icon: 'fa fa-fw fa-list' }
  ];
}
