import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { PlannerService } from './planner.service';
import { AuthService } from '../../auth/services/auth.service';
import { MatTableDataSource } from '@angular/material/table';
import { User } from '../../auth/interfaces/user.interface';
import { ProfileService } from '../profile/profile.service';

@Component({
  selector: 'app-planner',
  templateUrl: './planner.component.html',
  styleUrl: './planner.component.css'
})
export class PlannerComponent {
  displayedColumns: string[] = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
  weekDates: any = {};
  dataSource = new MatTableDataSource();
  plannerForm: FormGroup;
  public user?: User;
  activitiesList: any = [];
  data: any = [];
  selectedYear: any = new Date().getFullYear();
  years: number[] = [];
  currentYear = new Date().getFullYear();
  currentWeekDate = new Date();
  userRol: any;

  constructor(
    private fb: FormBuilder,
    private plannerService: PlannerService,
    private authService: AuthService,
    private profileService: ProfileService
  ) {
    this.plannerForm = this.fb.group({
      date:      ['', Validators.required],
      idTipeAct: ['', Validators.required],
    });
  }

  getUser(id: any) {
    this.profileService.getUserById(id).subscribe(
      (response: any) => {
        this.user = response.map((item: any) => {
          this.userRol = item.idRol;
        });
      }
    );
  }

  setParameters() {
    const {date, idTipeAct: [idTipeAct]} = this.plannerForm.value;
    const formattedDate = this.formatDate(date);
    this.data = { date: formattedDate, idTipeAct, dayOfWeek: '', idTeam: this.authService.currentUser?.idTeam };
  }

  getActivitiesTeam() {
    this.plannerService.getActivitiesById(this.data.idTeam).subscribe((resp: any) => {
      this.activitiesList = resp
      .filter((item: any) => {
        const itemDate = new Date(item.date);
        return (
          itemDate.getFullYear() == this.selectedYear &&
          this.isDateInCurrentWeek(itemDate)
        );
      })
      .map((item: any) => ({
        ...item,
        dayOfWeek: this.getDayOfWeek(item.date)
      }));

      this.weekDates = this.getWeekDates(this.currentWeekDate);

      this.dataSource = this.activitiesList.length
      ? this.activitiesList.map((item: any) => ({
          Monday: item.dayOfWeek == 'Monday' ? { id: item.id, name: item.name } : null,
          Tuesday: item.dayOfWeek == 'Tuesday' ? { id: item.id, name: item.name } : null,
          Wednesday: item.dayOfWeek == 'Wednesday' ? { id: item.id, name: item.name } : null,
          Thursday: item.dayOfWeek == 'Thursday' ? { id: item.id, name: item.name } : null,
          Friday: item.dayOfWeek == 'Friday' ? { id: item.id, name: item.name } : null
        }))
      : [
          {
            Monday: '',
            Tuesday: '',
            Wednesday: '',
            Thursday: '',
            Friday: ''
          }
        ];
    });
  }

  isDateInCurrentWeek(date: Date): boolean {
    const week = this.getWeekRange(this.currentWeekDate);

    return date >= week.start && date <= week.end;
  }

  getWeekRange(date: Date) {
    const current = new Date(date);
    const day = current.getDay();

    const diffToMonday = day == 0 ? -6 : 1 - day;

    const start = new Date(current);
    start.setDate(current.getDate() + diffToMonday);
    start.setHours(0, 0, 0, 0);

    const end = new Date(start);
    end.setDate(start.getDate() + 4);
    end.setHours(23, 59, 59, 999);

    return { start, end };
  }

  getWeekDates(date: Date) {
    const current = new Date(date);
    const day = current.getDay();

    const diffToMonday = day == 0 ? -6 : 1 - day;
    const monday = new Date(current);
    monday.setDate(current.getDate() + diffToMonday);

    return {
      Monday: this.formatDayDate(monday),
      Tuesday: this.formatDayDate(this.addDays(monday, 1)),
      Wednesday: this.formatDayDate(this.addDays(monday, 2)),
      Thursday: this.formatDayDate(this.addDays(monday, 3)),
      Friday: this.formatDayDate(this.addDays(monday, 4))
    };
  }

  addDays(date: Date, days: number): Date {
    const result = new Date(date);
    result.setDate(result.getDate() + days);
    return result;
  }

  formatDayDate(date: Date): string {
    return date.toLocaleDateString('es-ES', {
      day: '2-digit',
      month: '2-digit'
    });
  }

  getDateByDay(day: string): string {
    const activity = this.activitiesList.find((item: any) => item.dayOfWeek === day);

    return activity
      ? new Date(activity.date).toLocaleDateString('es-ES', {
          day: '2-digit',
          month: '2-digit'
        })
      : '';
  }

  generateYears() {
    this.years = [
      this.currentYear - 1,
      this.currentYear,
      this.currentYear + 1
    ];
  }

  onYearChange(year: number) {
    this.selectedYear = year;
    this.getActivitiesTeam();
  }

  getDayOfWeek(date: string): string {
    const newDate = new Date(date);
    const dayOfWeek = this.displayedColumns[newDate.getDay() - 1];
    return dayOfWeek;
  }

  previousWeek() {
    this.currentWeekDate = this.addDays(this.currentWeekDate, -7);
    this.getActivitiesTeam();
  }

  nextWeek() {
    this.currentWeekDate = this.addDays(this.currentWeekDate, 7);
    this.getActivitiesTeam();
  }

  addActivity() {
    if (this.plannerForm.invalid) {
      return;
    }
    this.setParameters();

    this.plannerService.addActivities(this.data).subscribe((response: any) => {
      this.getActivitiesTeam();
      this.plannerForm.reset();
    });
  }

  deleteActivity(idActivity: number) {
    this.plannerService.deleteActivityById(idActivity).subscribe(() => {
      this.getActivitiesTeam();
    });
  }

  formatDate(date: string): string {
    const newDate = new Date(date);
    const year = newDate.getFullYear();
    const month = (newDate.getMonth() + 1).toString().padStart(2, '0');
    const day = newDate.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  ngOnInit() {
    this.getUser(this.authService.currentUser?.id);
    this.setParameters();
    this.generateYears();
    this.onYearChange(this.currentYear);
    this.getActivitiesTeam();
  }
}
