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

  constructor(
    private tournamentService: TournamentService,
    private authService: AuthService,
    private profileService: ProfileService,
  ) { }

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
        this.userRol = response.length > 0 ? response[0].idRol : null;
      }
    );
  }

  deleteGameTeam(item: any) {}

  ngOnInit(): void {
    this.getUser(this.authService.currentUser?.id);
    this.getTournamentTeam(this.authService.currentUser?.idTeam);
    this.getGameTeam(this.authService.currentUser?.idTeam);
  }

}
