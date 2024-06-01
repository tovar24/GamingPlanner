import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { AuthService } from '../../auth/services/auth.service';
import { User } from '../../auth/interfaces/user.interface';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class ProfileService {
  private baseUrl = 'http://localhost/api/rest/posts.php';
  private user?: User;

  constructor(
    private http: HttpClient,
    private authService: AuthService
  ) { }

  getUserById(id: any): Observable<any> {

    return this.http.get(`${ this.baseUrl }/getUserById?id=` + id);
  }
}
