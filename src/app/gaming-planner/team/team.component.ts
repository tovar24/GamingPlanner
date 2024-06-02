import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TeamService } from './team.service';
import { AuthService } from '../../auth/services/auth.service';

export interface membersTeam {
  name: string;
  email: string;
  rol: string;
}

// const dataTable: membersTeam[] = [
//   {name: 'ADMIN', email: 'admin1234@gmail.com', rol: 1},
//   {name: 'pruebaAPI', email: 'prueba1@gmail.com', rol: 1},
//   {name: 'prueba2', email: 'prueba2@gmail.com', rol: 1}
// ]

@Component({
  selector: 'app-team',
  templateUrl: './team.component.html',
  styleUrl: './team.component.css'
})
export class TeamComponent implements OnInit, AfterViewInit {
  @ViewChild(MatSort)
  sort: MatSort = new MatSort;
  public members: membersTeam[] = [];
  displayedColumns: string[] = ['name', 'email', 'rol', 'delete'];
  dataSource = new MatTableDataSource();

  public team: any = [];
  myForm: FormGroup;

  constructor(
    private fb: FormBuilder,
    private teamService: TeamService,
    private authService: AuthService
  ) {
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

  getTeamById(id: any) {
    this.teamService.getTeamById(id).subscribe(
      (response: any) => {
        this.team = response;
      }
    );
  }

  getMembersTeam(idTeam: any) {
    this.teamService.getMembersTeam(idTeam).subscribe(
      (response: membersTeam[]) => {
        this.members = response;
        this.dataSource.data = this.members;
      }
    );
  }

  deleteMember(member: any) {
    // this.dataSource = this.dataSource.filter((item: any) => item !== member);
  }

  ngAfterViewInit(): void {
    this.dataSource.sort = this.sort;
  }

  ngOnInit(): void {
    this.getTeamById(this.authService.currentUser?.idTeam);
    this.getMembersTeam(this.authService.currentUser?.idTeam);
  }
}
