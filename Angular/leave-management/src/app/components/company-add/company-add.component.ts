
import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, ActivatedRoute } from '@angular/router';
import { CompanyService } from '../../services/company.service';
import { Company } from '../../models/company.model';

@Component({
  selector: 'app-company-add',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './company-add.component.html',
  styleUrls: ['./company-add.component.css']
})
export class CompanyAddComponent implements OnInit {
  company: Company = {
    COMPANYNAME: '',
    COMPANYADDRESS: '',
    COMPANYCONTACTNO: ''
  };
  
  isEditMode = false;
  isLoading = false;
  errorMessage = '';
  successMessage = '';

  constructor(
    private companyService: CompanyService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    const id = this.route.snapshot.paramMap.get('id');
    if (id) {
      this.isEditMode = true;
      this.loadCompany(parseInt(id));
    }
  }

  loadCompany(id: number): void {
    this.isLoading = true;
    this.companyService.getCompanyById(id).subscribe({
      next: (data) => {
        this.company = data;
        this.isLoading = false;
      },
      error: (error) => {
        this.errorMessage = 'Error loading company: ' + error;
        this.isLoading = false;
      }
    });
  }

  onSubmit(): void {
    if (this.validateForm()) {
      this.isLoading = true;
      this.errorMessage = '';

      if (this.isEditMode) {
        this.companyService.updateCompany(this.company.COMPANYID!, this.company).subscribe({
          next: () => {
            this.successMessage = 'Company updated successfully!';
            this.isLoading = false;
            setTimeout(() => this.router.navigate(['/companies']), 2000);
          },
          error: (error) => {
            this.errorMessage = 'Error updating company: ' + error;
            this.isLoading = false;
          }
        });
      } else {
        this.companyService.createCompany(this.company).subscribe({
          next: () => {
            this.successMessage = 'Company created successfully!';
            this.isLoading = false;
            setTimeout(() => this.router.navigate(['/companies']), 2000);
          },
          error: (error) => {
            this.errorMessage = 'Error creating company: ' + error;
            this.isLoading = false;
          }
        });
      }
    }
  }

  validateForm(): boolean {
    if (!this.company.COMPANYNAME?.trim()) {
      this.errorMessage = 'Company name is required';
      return false;
    }
    if (!this.company.COMPANYADDRESS?.trim()) {
      this.errorMessage = 'Company address is required';
      return false;
    }
    if (!this.company.COMPANYCONTACTNO?.trim()) {
      this.errorMessage = 'Company contact number is required';
      return false;
    }
    return true;
  }

  cancel(): void {
    this.router.navigate(['/companies']);
  }
}
