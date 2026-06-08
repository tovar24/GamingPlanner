import { ProfileService } from './../profile/profile.service';
import { Component, OnInit } from '@angular/core';
import { TournamentService } from './tournament.service';
import { AuthService } from '../../auth/services/auth.service';

@Component({
  selector: 'app-tournament',
  templateUrl: './tournament.component.html',
  styleUrl: './tournament.component.css'
})
export class TournamentComponent implements OnInit {
  public userRol: any;
  public tournamentList: any = [];
  public gameList: any = [];
  public selectedTeam: any;
  public teams: any[] = [];
  public userTeam: any;

  constructor(
    private tournamentService: TournamentService,
    private authService: AuthService,
    private profileService: ProfileService,
  ) { }

  onTeamChange(idTeam: any) {
    this.selectedTeam = idTeam;
    this.getTournamentTeam(idTeam);
    this.getGameTeam(idTeam);
  }

  getTournamentTeam(idTeam: any) {
    this.tournamentService.getTournamentTeam(idTeam).subscribe(
      (response: any) => {
        this.tournamentList = response;
      }
    );
  }

  getGameTeam(idTeam: any) {
    this.tournamentService.getGameTeam(idTeam).subscribe(
      (response: any) => {
        this.gameList = response;
      }
    );
  }

  getAllTeams() {
    this.tournamentService.getAllTeams().subscribe(
      (response: any) => {
        this.teams = response;
      }
    );
  }

  getMonthName(dateString: string): string {
    const date = new Date(dateString);
    const month = new Intl.DateTimeFormat('es-ES', { month: 'long' }).format(date);
    return month.charAt(0).toUpperCase() + month.slice(1);
  }

  getGamesByTournament(tournamentId: any) {
    return this.gameList.filter((game: any) => game.idTournament == tournamentId);
  }

  getUser(id: any) {
    this.profileService.getUserById(id).subscribe(
      (response: any) => {
        this.userTeam = response.length > 0 ? response[0].idTeam : null;
        this.userRol = response.length > 0 ? response[0].idRol : null;
      }
    );
  }

  updateViewGameTeam(game: any, view: any) {
    const data = {
      ...game,
      visible: view
    };

    this.tournamentService.updateViewGameTeam(data).subscribe(
      (response: any) => {
        if (response) {
          this.getGameTeam(this.selectedTeam ? this.selectedTeam : this.authService.currentUser?.idTeam);
        }
      }
    );
  }

  ngOnInit(): void {
    this.getUser(this.authService.currentUser?.id);
    this.getTournamentTeam(this.selectedTeam ? this.selectedTeam : this.authService.currentUser?.idTeam);
    this.getGameTeam(this.selectedTeam ? this.selectedTeam : this.authService.currentUser?.idTeam);
    this.getAllTeams();
  }

}
