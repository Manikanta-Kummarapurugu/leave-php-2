
import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { Employee } from '../../models/employee.model';
import { Company } from '../../models/company.model';
import { Department } from '../../models/department.model';
import { EmployeeService } from '../../services/employee.service';
import { CompanyService } from '../../services/company.service';
import { DepartmentService } from '../../services/department.service';

@Component({
  selector: 'app-employee-add',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './employee-add.component.html',
  styleUrls: ['./employee-add.component.css']
})
export class EmployeeAddComponent implements OnInit {
  employee: Partial<Employee> = {
    EMPNAME: '',
    MNAME: '',
    LNAME: '',
    EMPSEX: '',
    COMPANYID: 0,
    DEPARTMENTID: 0,
    POSITION: '',
    DATEHIRED: '',
    USERNAME: '',
    PASS: '',
    TYPE: 'Employee'
  };
  
  companies: Company[] = [];
  departments: Department[] = [];
  isEditMode = false;
  employeeId: number | null = null;

  constructor(
    private employeeService: EmployeeService,
    private companyService: CompanyService,
    private departmentService: DepartmentService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.loadCompanies();
    this.loadDepartments();
    
    this.route.params.subscribe(params => {
      if (params['id']) {
        this.isEditMode = true;
        this.employeeId = +params['id'];
        this.loadEmployee(this.employeeId);
      }
    });
  }

  loadCompanies(): void {
    this.companyService.getCompanies().subscribe({
      next: (data) => {
        this.companies = data;
      },
      error: (error) => {
        console.error('Error loading companies:', error);
      }
    });
  }

  loadDepartments(): void {
    this.departmentService.getDepartments().subscribe({
      next: (data) => {
        this.departments = data;
      },
      error: (error) => {
        console.error('Error loading departments:', error);
      }
    });
  }

  loadEmployee(id: number): void {
    this.employeeService.getEmployee(id).subscribe({
      next: (data) => {
        this.employee = data;
      },
      error: (error) => {
        console.error('Error loading employee:', error);
      }
    });
  }

  onSubmit(): void {
    if (this.isEditMode && this.employeeId) {
      this.updateEmployee();
    } else {
      this.createEmployee();
    }
  }

  createEmployee(): void {
    this.employeeService.createEmployee(this.employee as Employee).subscribe({
      next: () => {
        alert('Employee created successfully');
        this.router.navigate(['/employees']);
      },
      error: (error) => {
        console.error('Error creating employee:', error);
        alert('Error creating employee');
      }
    });
  }

  updateEmployee(): void {
    if (this.employeeId) {
      this.employeeService.updateEmployee(this.employeeId, this.employee as Employee).subscribe({
        next: () => {
          alert('Employee updated successfully');
          this.router.navigate(['/employees']);
        },
        error: (error) => {
          console.error('Error updating employee:', error);
          alert('Error updating employee');
        }
      });
    }
  }

  cancel(): void {
    this.router.navigate(['/employees']);
  }
}
