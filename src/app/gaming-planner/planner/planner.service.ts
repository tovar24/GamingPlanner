import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class PlannerService {
  private baseUrl = 'http://localhost/api/rest/posts.php';

  constructor(private http: HttpClient) { }

  getAllTeams(): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getAllTeams`);
  }

  addActivities(data: any): Observable<any> {
    const jsonData = JSON.stringify(data);
    return this.http.post(`${this.baseUrl}/insertActivities`, jsonData);
  }

  getActivitiesById(idTeam: any,month: number, year: number): Observable<any> {
    return this.http.get(`${ this.baseUrl }/getActivitiesById?idTeam=` + idTeam + `&month=` + month + `&year=` + year);
  }

  deleteActivityById(idActivity: number): Observable<any> {
    return this.http.delete(`${this.baseUrl}/deleteActivityById?id=${idActivity}`);
  }

}
