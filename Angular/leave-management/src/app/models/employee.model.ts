export interface Employee {
  EMPID?: number;
  EMPLOYEENO: string;
  FNAME: string;
  LNAME: string;
  MNAME?: string;
  ADDRESS: string;
  CONTACTNO: string;
  COMPANYID: number;
  DEPARTMENTID: number;
  POSITION: string;
  STARTDATE: Date;
  USERNAME: string;
  PASS?: string;
  EMPTYPE: 'Administrator' | 'Supervisor' | 'Manager' | 'Normal user';
  EMPSTATUS: 'Active' | 'Inactive';
  PICLOCATION?: string;
  createdAt?: Date;
  updatedAt?: Date;
}