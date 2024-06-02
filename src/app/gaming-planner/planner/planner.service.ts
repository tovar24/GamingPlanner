import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class PlannerService {
  private baseUrl = 'http://localhost/api/rest/posts.php';

  constructor(private http: HttpClient) { }

  addActivities(data: any): Observable<any> {
    const jsonData = JSON.stringify(data);
    return this.http.post(`${this.baseUrl}/insertActivities`, jsonData);
  }
}
