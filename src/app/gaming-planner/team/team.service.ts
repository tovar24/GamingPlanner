import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class TeamService {
  private baseUrl = 'http://localhost/api/rest/posts.php';

  constructor(private http: HttpClient) { }

  getAllRoles(): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getAllRoles`);
  }

  getAllTeams(): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getAllTeams`);
  }

  getTeamById(id: any): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getTeamById?id=` + id);
  }

  getMembersTeam(idTeam: any): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getMembersTeam?idTeam=` + idTeam);
  }

  getUsersWithoutTeam(): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getUsersWithoutTeam`);
  }

  updateTeam(data: any): Observable<any> {
    const jsonData = JSON.stringify(data);
    return this.http.put(`${ this.baseUrl }/updateTeam`, jsonData);
  }

}
