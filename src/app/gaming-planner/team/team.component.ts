import { AfterViewInit, Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { TeamService } from './team.service';
import { AuthService } from '../../auth/services/auth.service';
import { ProfileService } from './../profile/profile.service';
import { User } from '../../auth/interfaces/user.interface';

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

  public user?: User;
  public rol: any = [];
  public team: any = [];
  public teamName: any;
  public userRol: any;
  public userTeamId: any;
  public submitted = false;
  public allTeams: any[] = [];
  public usersWithoutTeam: any[] = [];
  private currentUserId = this.authService.currentUser?.id;
  public formTeam!: FormGroup;

  constructor(
    private fb: FormBuilder,
    private teamService: TeamService,
    private authService: AuthService,
    private profileService: ProfileService
  ) {
    this.formTeam = this.fb.group({
      idTeam: ['', Validators.required],
      idUser: ['', Validators.required]
    });
  }

  getUser(id: any) {
    this.profileService.getUserById(id).subscribe(
      (response: any) => {
        this.user = response.map((item: any) => {
          this.userRol = item.idRol;

          if(this.userRol == '5') {
            this.getAllTeams();
          }
        });
      }
    );
  }

  getUserWithoutTeam() {
    this.teamService.getUsersWithoutTeam().subscribe(
      (response: any) => {
        this.usersWithoutTeam = response;
      }
    )
  }

  getAllTeams() {
    this.teamService.getAllTeams().subscribe(
      (response: any) => {
        this.allTeams = response;
      }
    );
  }

  onTeamChange(selectedTeamId: any) {
    if(this.userRol == '5') {
      const selectedTeam = this.allTeams.find(team => team.id == selectedTeamId);

      if (selectedTeam) {
        this.teamName = selectedTeam.name;
      }

      this.getMembersTeam(selectedTeamId);
    }
  }


  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();
  }

  getRoles() {
    this.teamService.getAllRoles().subscribe(
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
            this.userTeamId = item.id;
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
      idTeam: null,
      idUser: item.id
    };

    this.teamService.updateTeam(data).subscribe(
      (response: any) => {
        const currentSelectedTeam = this.formTeam.get('idTeam')?.value || this.authService.currentUser?.idTeam;
        this.getMembersTeam(currentSelectedTeam);
        this.getUserWithoutTeam();
      }
    );
  }

  addMember() {
    this.submitted = true;
    if (this.formTeam.invalid) {
      return;
    }

    const data = this.formTeam.value;

    this.teamService.updateTeam(data).subscribe(
      (response: any) => {
        const currentSelectedTeam = this.formTeam.get('idTeam')?.value;
        this.getMembersTeam(currentSelectedTeam);
        this.formTeam.get('idUser')?.reset();
        this.submitted = false;
        this.getUserWithoutTeam();
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
    this.getRoles();
    this.getUser(this.currentUserId);
    this.getTeamById(this.authService.currentUser?.idTeam);
    this.getMembersTeam(this.authService.currentUser?.idTeam);
    this.getUserWithoutTeam();
  }
}
