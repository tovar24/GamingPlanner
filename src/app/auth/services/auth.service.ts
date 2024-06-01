import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { User } from '../interfaces/user.interface';
import { Observable } from 'rxjs';
import { Router } from '@angular/router';

@Injectable({providedIn: 'root'})
export class AuthService {

  private baseUrl = 'http://localhost';
  private user?: User;

  constructor(
    private http: HttpClient,
    private router: Router
  ) { }

  get currentUser(): User|undefined {
    const userJson = localStorage.getItem('User');

    if (userJson) {
      // Parsear el objeto User desde el JSON
      this.user = JSON.parse(userJson);
    }
    return this.user;
  }

  // Iniciar sesión
  login(data: any) {
    const jsonData = JSON.stringify(data);
    this.http.post<User>(`${this.baseUrl}/api/rest/posts.php/login`, jsonData).subscribe(
      (response: any) => {
        const user: User = {
          id: response.id,
          name: response.name,
          email: data.email,
          idRol: response.idRol,
          idTeam: response.idTeam
        }

        // Almacenar el estado de inicio de sesión en el localStorage
        localStorage.setItem('User', JSON.stringify(user));
        this.router.navigate(['/gaming-planner']);
      }, (error: any) => {
        console.error('Error de al iniciar sesión', error);
      }
    );
  }

  // Cerrar sesión
  logout() {
    this.user = undefined;
    localStorage.clear();
  }

  // Registrar un nuevo usuario
  register(data: any) {
    const jsonData = JSON.stringify(data);
    this.http.post<User>(`${this.baseUrl}/api/rest/posts.php/register`, jsonData).subscribe(
      (response: any) => {
        // Redirige al usuario al login
        this.router.navigate(['auth/login']);
        // window.location.href = 'login'
      }, (error: any) => {
        console.error('Algo salió mal con el registro', error);
      }
    );
  }

  // Verificar el email ingresado
  checkEmail(data: any) {
    const jsonData = JSON.stringify(data);
    this.http.post(`${this.baseUrl}/api/rest/posts.php/checkEmail`, jsonData).subscribe(
      (response: any) => {
        if (response[0].count == 0) {
          this.register(data);
        } else {
          console.log('El email ya existe');
        }
      }, (error: any) => {
        console.error('Algo salió mal', error);
      }
    );
  }
}
