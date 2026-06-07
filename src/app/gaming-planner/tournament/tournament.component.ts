import { Component, OnInit } from '@angular/core';
import { TournamentService } from './tournament.service';
import { AuthService } from '../../auth/services/auth.service';

@Component({
  selector: 'app-tournament',
  templateUrl: './tournament.component.html',
  styleUrl: './tournament.component.css'
})
export class TournamentComponent implements OnInit {
  public tournamentList: any = [];
  public gameList: any = [];

  constructor(
    private tournamentService: TournamentService,
    private authService: AuthService
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

  ngOnInit(): void {
    this.getTournamentTeam(this.authService.currentUser?.idTeam);
    this.getGameTeam(this.authService.currentUser?.idTeam);
  }

}
