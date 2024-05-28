import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

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

  constructor(private fb: FormBuilder) {
    this.plannerForm = this.fb.group({
      day:      ['', Validators.required],
      activity: ['', Validators.required],
    });
  }

  addActivity() {

    this.activitiesList.push(this.plannerForm.value);

    console.log(this.activitiesList);

  }
}
