import { AfterViewInit, Component, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';

export interface membersTeam {
  name: string;
  email: string;
  rol: string;
}

const dataTable: membersTeam[] = [
  {name: 'ADMIN', email: 'admin1234@gmail.com', rol: 'CEO'},
  {name: 'pruebaAPI', email: 'prueba1@gmail.com', rol: 'STAFF'},
  {name: 'prueba2', email: 'prueba2@gmail.com', rol: 'COACH'}
]

@Component({
  selector: 'app-team',
  templateUrl: './team.component.html',
  styleUrl: './team.component.css'
})
export class TeamComponent implements AfterViewInit {
  @ViewChild(MatSort)
  sort: MatSort = new MatSort;
  displayedColumns: string[] = ['name', 'email', 'rol', 'delete'];
  dataSource = new MatTableDataSource(dataTable);

  myForm: FormGroup;

  constructor(private fb: FormBuilder) {
    this.myForm = this.fb.group({
      nombre: ['', Validators.required],
      email : ['', [Validators.required, Validators.email]],
      rol   : ['', Validators.required]
    });
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  deleteMember(member: any) {
    // this.dataSource = this.dataSource.filter((item: any) => item !== member);
  }

  ngAfterViewInit(): void {
    this.dataSource.sort = this.sort;
  }
}
