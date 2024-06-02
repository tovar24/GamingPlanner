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

  public rol: any = [];
  public team: any = [];
  public teamName: any;
  public formTeam!: FormGroup;

  constructor(
    private fb: FormBuilder,
    private teamService: TeamService,
    private authService: AuthService
  ) {
    this.formTeam = this.fb.group({
      idTeam: ['', Validators.required],
      name: ['', [Validators.required, Validators.minLength(3)]]
    });
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  getRoles() {
    this.teamService.getAllRol().subscribe(
      (response: any) => {
        this.rol = response;
      }
    );
  }

  getTeamById(id: any) {
    this.teamService.getTeamById(id).subscribe(
      (response: any) => {
        this.team = response;
        this.team.map(
          (item: any) => {
            this.teamName = item.name;
          }
        );
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

  deleteMember(item: any) {
    const data = {
      idTeam: item.idTeam = null,
      name: item.name
    };

    this.teamService.updateTeam(data).subscribe(
      (response: any) => {
        this.getMembersTeam(this.authService.currentUser?.idTeam);
      }
    );
  }

  addMember() {
    const data = this.formTeam.value;

    if (this.formTeam.invalid) {
      return;
    }

    this.teamService.updateTeam(data).subscribe(
      (response: any) => {
        if (response.idTeam === this.authService.currentUser?.idTeam) {
          this.members.push(response);
          this.getMembersTeam(this.authService.currentUser?.idTeam);
        } else {
          this.getMembersTeam(this.authService.currentUser?.idTeam);
        }
      },
      (error: any) => {
        console.error('Error:', error);
      }
    );
  }

  get idTeam() {
    return this.formTeam.get('idTeam')
  }

  get name() {
    return this.formTeam.get('name')
  }

  ngAfterViewInit(): void {
    this.dataSource.sort = this.sort;
  }

  ngOnInit(): void {
    this.getTeamById(this.authService.currentUser?.idTeam);
    this.getMembersTeam(this.authService.currentUser?.idTeam);
  }
}
