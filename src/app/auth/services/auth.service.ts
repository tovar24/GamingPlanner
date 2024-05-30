import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { User } from '../interfaces/user.interface';
import { Observable } from 'rxjs';

@Injectable({providedIn: 'root'})
export class AuthService {

  private baseUrl = 'http://localhost:3306';
  private user?: User;

  constructor(private http: HttpClient) { }

  get currentUser(): User|undefined {
    if (!this.user) return undefined;
    return structuredClone(this.user);
  }

  login(data: any) {
    const jsonData = JSON.stringify(data);
    this.http.post<User>(`${this.baseUrl}/api/rest/posts.php/login`, jsonData).subscribe(
      (response: any) => {
        const user: User = {
          id: response[0].id,
          name: response.name,
          email: data.email,
          idRol: response.idRol,
          idTeam: response.idTeam
        }

        // Almacenar el estado de inicio de sesión en el localStorage
        localStorage.setItem('User', JSON.stringify(user));
        window.location.href = '';
      }, (error: any) => {
        console.log('Error de al iniciar sesión', error);
      }
    );
  }

  logout() {
    this.user = undefined;
    localStorage.clear();
  }
}
