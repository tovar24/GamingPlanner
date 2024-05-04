import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-layout-page',
  templateUrl: './layout-page.component.html',
  styleUrl: './layout-page.component.css'
})
export class LayoutPageComponent {

  public sidebarItems = [
    { label: 'Dashboard', icon: 'dashboard', url: './dashboard' },
    { label: 'Planificador', icon: 'edit_note', url: './planner' },
    { label: 'Torneos', icon: 'emoji_events', url: './tournament' },
    { label: 'Equipo', icon: 'group', url: './team' },
    { label: 'Perfil', icon: 'manage_accounts', url: './profile' },
  ];

  constructor(
    private router: Router,
  ) {}

  // TODO: verificar usuario y botón de logout
}
