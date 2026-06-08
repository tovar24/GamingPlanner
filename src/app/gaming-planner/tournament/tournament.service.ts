import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class TournamentService {
  private baseUrl = 'http://localhost/api/rest/posts.php';

  constructor(private http: HttpClient) { }

  getTournamentTeam(idTeam: any): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getTournamentTeam?idTeam=` + idTeam);
  }

  getGameTeam(idTeam: any): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getGameTeam?idTeam=` + idTeam);
  }

  getAllTeams(): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getAllTeams`);
  }

  updateViewGameTeam(data: any): Observable<any> {
    const jsonData = JSON.stringify(data);
    return this.http.put(`${ this.baseUrl }/updateViewGameTeam`, jsonData);
  }

}
