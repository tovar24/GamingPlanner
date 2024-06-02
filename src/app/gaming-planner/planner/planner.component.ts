import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { PlannerService } from './planner.service';

@Component({
  selector: 'app-planner',
  templateUrl: './planner.component.html',
  styleUrl: './planner.component.css'
})
export class PlannerComponent {
  displayedColumns: string[] = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
  plannerForm: FormGroup;
  daysList: string[] = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
  activityList: string[] = ['VOD', 'Teórico', 'PRACC'];
  activitiesList: string[] = [];

  constructor(
    private fb: FormBuilder,
    private plannerService: PlannerService
  ) {
    this.plannerForm = this.fb.group({
      date:     ['', Validators.required],
      activity: ['', Validators.required],
    });
  }

  addActivity() {

    if (this.plannerForm.invalid) {
      return;
    }

    const data = this.plannerForm.value;

    this.plannerService.addActivities(data).subscribe(
      (response: any) => {
        this.activitiesList = response;
      }
    )

  }
}
