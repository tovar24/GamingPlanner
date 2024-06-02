import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class TeamService {
  private baseUrl = 'http://localhost/api/rest/posts.php';

  constructor(private http: HttpClient) { }

  getTeamById(id: any): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getTeamById?id=` + id);
  }

  getMembersTeam(idTeam: any): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getMembersTeam?idTeam=` + idTeam);
  }

}
