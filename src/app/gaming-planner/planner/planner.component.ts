import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { PlannerService } from './planner.service';
import { AuthService } from '../../auth/services/auth.service';

@Component({
  selector: 'app-planner',
  templateUrl: './planner.component.html',
  styleUrl: './planner.component.css'
})
export class PlannerComponent {
  displayedColumns: string[] = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
  plannerForm: FormGroup;
  daysList: string[] = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
  activitiesList: any = [];
  data: any = [];

  constructor(
    private fb: FormBuilder,
    private plannerService: PlannerService,
    private authService: AuthService
  ) {
    this.plannerForm = this.fb.group({
      date:      ['', Validators.required],
      idTipeAct: ['', Validators.required],
    });
  }

  addActivity() {

    if (this.plannerForm.invalid) {
      return;
    }

    const {date, idTipeAct: [idTipeAct]} = this.plannerForm.value;
    const formattedDate = this.formatDate(date);
    this.data = { date: formattedDate, idTipeAct, idTeam: this.authService.currentUser?.idTeam };

    this.plannerService.addActivities(this.data).subscribe(
      (response: any) => {
        this.plannerService.getActivitiesById(response[0].idTeam).subscribe(
          (resp: any) => {
            this.activitiesList = resp;
          }
        );
      }
    )
  }

  formatDate(date: string): string {
    const newDate = new Date(date);
    const year = newDate.getFullYear();
    const month = (newDate.getMonth() + 1).toString().padStart(2, '0');
    const day = newDate.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
  }
}
