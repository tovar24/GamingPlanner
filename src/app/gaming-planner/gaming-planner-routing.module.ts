import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LayoutPageComponent } from './layout-page/layout-page.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { PlannerComponent } from './planner/planner.component';
import { TournamentComponent } from './tournament/tournament.component';
import { TeamComponent } from './team/team.component';
import { ProfileComponent } from './profile/profile.component';


const routes: Routes = [
  {
    path: '',
    component: LayoutPageComponent,
    children: [
      { path: 'dashboard', component: DashboardComponent },
      { path: 'planner', component: PlannerComponent },
      { path: 'tournament', component: TournamentComponent },
      { path: 'team', component: TeamComponent },
      { path: 'profile', component: ProfileComponent },
      { path: '**', redirectTo: 'planner' },
    ]
  }
]

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class GamingPlannerRoutingModule { }
