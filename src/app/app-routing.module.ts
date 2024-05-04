import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'auth',
    loadChildren: () => import('./auth/auth.module').then(m => m.AuthModule),
  },
  {
    path: 'gaming-planner',
    loadChildren: () => import('./gaming-planner/gaming-planner.module').then(m => m.GamingPlannerModule),
  },
  {
    path: '',
    redirectTo: 'gaming-planner',
    pathMatch: 'full'
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
