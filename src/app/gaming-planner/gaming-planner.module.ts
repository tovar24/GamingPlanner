import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';

import { GamingPlannerRoutingModule } from './gaming-planner-routing.module';
import { MaterialModule } from '../angular-material/material.module';

// COMPONENTES
import { DashboardComponent } from './dashboard/dashboard.component';
import { PlannerComponent } from './planner/planner.component';
import { TournamentComponent } from './tournament/tournament.component';
import { TeamComponent } from './team/team.component';
import { ProfileComponent } from './profile/profile.component';
import { LayoutPageComponent } from './layout-page/layout-page.component';


@NgModule({
  imports: [
    CommonModule,
    GamingPlannerRoutingModule,
    ReactiveFormsModule,
    MaterialModule
  ],
  declarations: [
    DashboardComponent,
    PlannerComponent,
    TournamentComponent,
    TeamComponent,
    ProfileComponent,
    LayoutPageComponent
  ],
})
export class GamingPlannerModule { }
