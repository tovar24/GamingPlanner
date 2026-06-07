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
  selectedMonth: any = new Date().getMonth() + 1;
  startMonth: any;
  startYear: any;
  endMonth: any;
  endYear: any;
  currentYear = new Date().getFullYear();
  currentWeekDate = new Date();
  userRol: any;
  submitted = false;
  years: any[] = [];
  months = [
  { value: 1, name: 'Enero' },
  { value: 2, name: 'Febrero' },
  { value: 3, name: 'Marzo' },
  { value: 4, name: 'Abril' },
  { value: 5, name: 'Mayo' },
  { value: 6, name: 'Junio' },
  { value: 7, name: 'Julio' },
  { value: 8, name: 'Agosto' },
  { value: 9, name: 'Septiembre' },
  { value: 10, name: 'Octubre' },
  { value: 11, name: 'Noviembre' },
  { value: 12, name: 'Diciembre' }
];

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
        if (response && response.length > 0) {
          this.userRol = response[0].idRol;
        }
      }
    );
  }

  setParameters() {
    const formControl = this.plannerForm.get('date');
    const formDate = formControl && formControl.value ? formControl.value : null;
    const dateToFormat = formDate ? formDate : this.currentWeekDate;
    const formattedDate = this.formatDate(dateToFormat);
    const idTipeAct = this.plannerForm.get('idTipeAct')?.value;

    this.data = {
      date: formattedDate,
      idTipeAct: Array.isArray(idTipeAct) ? idTipeAct[0] : idTipeAct,
      dayOfWeek: '',
      idTeam: this.authService.currentUser?.idTeam
    };

  }

  parseLocalDate(date: string): Date {
    const [year, month, day] = date.split('-').map(Number);
    return new Date(year, month - 1, day);
  }

  async getActivitiesTeam() {
    const idTeam = this.authService.currentUser?.idTeam;
    if (!idTeam) return;

    this.setParametersMonthYear();

    try {
      const resp1 = await this.plannerService.getActivitiesById(idTeam, this.startMonth, this.startYear).toPromise();
      let combinedResp = [...(resp1 || [])];

      if (this.startMonth != this.endMonth || this.startYear !== this.endYear) {
        const resp2 = await this.plannerService.getActivitiesById(idTeam, this.endMonth, this.endYear).toPromise();
        combinedResp = [...combinedResp, ...(resp2 || [])];
      }

      this.filterAndMapActivities(combinedResp);
      this.buildTableRows();
    } catch (error) {

    }
  }

  setParametersMonthYear() {
    const week = this.getWeekRange(this.currentWeekDate);
    this.startMonth = week.start.getMonth() + 1;
    this.startYear = week.start.getFullYear();
    this.endMonth = week.end.getMonth() + 1;
    this.endYear = week.end.getFullYear();
  }

  filterAndMapActivities(activities: any[]) {
    this.activitiesList = activities
      .filter((item: any) => {
        const itemDate = this.parseLocalDate(item.date);
        return this.isDateInCurrentWeek(itemDate);
      })
      .map((item: any) => ({
        ...item,
        dayOfWeek: this.getDayOfWeek(item.date)
      }));

      this.weekDates = this.getWeekDates(this.currentWeekDate);
  }

  buildTableRows() {
    const maxRows = Math.max(
      this.activitiesList.filter((a: any) => a.dayOfWeek == 'Monday').length,
      this.activitiesList.filter((a: any) => a.dayOfWeek == 'Tuesday').length,
      this.activitiesList.filter((a: any) => a.dayOfWeek == 'Wednesday').length,
      this.activitiesList.filter((a: any) => a.dayOfWeek == 'Thursday').length,
      this.activitiesList.filter((a: any) => a.dayOfWeek == 'Friday').length,
      1
    );

    const tableRows: any[] = [];
    for (let i = 0; i < maxRows; i++) {
      const mondayActs = this.activitiesList.filter((a: any) => a.dayOfWeek == 'Monday');
      const tuesdayActs = this.activitiesList.filter((a: any) => a.dayOfWeek == 'Tuesday');
      const wednesdayActs = this.activitiesList.filter((a: any) => a.dayOfWeek == 'Wednesday');
      const thursdayActs = this.activitiesList.filter((a: any) => a.dayOfWeek == 'Thursday');
      const fridayActs = this.activitiesList.filter((a: any) => a.dayOfWeek == 'Friday');

      tableRows.push({
        Monday: mondayActs[i] ? { id: mondayActs[i].id, name: mondayActs[i].name, idTipeAct: mondayActs[i].idTipeAct } : null,
        Tuesday: tuesdayActs[i] ? { id: tuesdayActs[i].id, name: tuesdayActs[i].name, idTipeAct: tuesdayActs[i].idTipeAct } : null,
        Wednesday: wednesdayActs[i] ? { id: wednesdayActs[i].id, name: wednesdayActs[i].name, idTipeAct: wednesdayActs[i].idTipeAct } : null,
        Thursday: thursdayActs[i] ? { id: thursdayActs[i].id, name: thursdayActs[i].name, idTipeAct: thursdayActs[i].idTipeAct } : null,
        Friday: fridayActs[i] ? { id: fridayActs[i].id, name: fridayActs[i].name, idTipeAct: fridayActs[i].idTipeAct } : null,
      });
    }

    this.dataSource.data = tableRows;

  }

  isDateInCurrentWeek(date: Date): boolean {
    const week = this.getWeekRange(this.currentWeekDate);


    const target = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0, 0).getTime();
    const start = new Date(week.start.getFullYear(), week.start.getMonth(), week.start.getDate(), 0, 0, 0, 0).getTime();
    const end = new Date(week.end.getFullYear(), week.end.getMonth(), week.end.getDate(), 0, 0, 0, 0).getTime();

    return target >= start && target <= end;
  }

  getWeekRange(date: Date) {
    const current = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    const day = current.getDay();

    const diffToMonday = day == 0 ? -6 : 1 - day;

    const start = new Date(current);
    start.setDate(current.getDate() + diffToMonday);

    const end = new Date(start);
    end.setDate(start.getDate() + 4);

    return { start, end };
  }

  getWeekDates(date: Date) {
    const current = new Date(date.getFullYear(), date.getMonth(), date.getDate());
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

  generateYears() {
    this.years = [
      this.currentYear - 1,
      this.currentYear,
      this.currentYear + 1
    ];
  }

  onYearChange(year: number) {
    this.selectedYear = year;
    this.currentWeekDate = new Date(this.selectedYear, this.selectedMonth - 1, 1);
    this.setParameters();
    this.getActivitiesTeam();
  }

  onMonthChange(month: number) {
    this.selectedMonth = month;
    this.currentWeekDate = new Date(this.selectedYear, this.selectedMonth - 1, 1);
    this.setParameters();
    this.getActivitiesTeam();
  }

  getSelectedMonthName(): string {
    return this.months.find(month => month.value == this.selectedMonth)?.name || '';
  }

  getDayOfWeek(date: string): string {
    const newDate = this.parseLocalDate(date);
    const day = newDate.getDay();
    const adjustedIndex = day == 0 ? 6 : day - 1;
    return this.displayedColumns[adjustedIndex] || '';
  }

  previousWeek() {
    this.currentWeekDate = this.addDays(this.currentWeekDate, -7);
    this.syncSelectedYearMonth();
    this.setParameters();
    this.getActivitiesTeam();
  }

  private syncSelectedYearMonth() {
    const weekRange = this.getWeekRange(this.currentWeekDate);
    this.selectedYear = weekRange.start.getFullYear();
    this.selectedMonth = weekRange.start.getMonth() + 1;
  }

  nextWeek() {
    this.currentWeekDate = this.addDays(this.currentWeekDate, 7);
    this.syncSelectedYearMonth();
    this.setParameters();
    this.getActivitiesTeam();
  }

  addActivity() {
    this.submitted = true;
    if (this.plannerForm.invalid) return;
    this.setParameters();

    this.plannerService.addActivities(this.data).subscribe((response: any) => {
      this.plannerForm.reset();
      this.submitted = false;
      this.setParameters();
      this.getActivitiesTeam();
    });
  }

  deleteActivity(idActivity: number) {
    this.plannerService.deleteActivityById(idActivity).subscribe(() => {
      this.getActivitiesTeam();
    });
  }

  formatDate(date: string): string {
    const newDate = new Date(date);
    if (isNaN(newDate.getTime())) return '';
    const year = newDate.getFullYear();
    const month = (newDate.getMonth() + 1).toString().padStart(2, '0');
    const day = newDate.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  ngOnInit() {
    this.getUser(this.authService.currentUser?.id);
    this.generateYears();

    const today = new Date();
    this.selectedYear = today.getFullYear();
    this.selectedMonth = today.getMonth() + 1;
    this.currentWeekDate = today;

    this.setParameters();
    this.getActivitiesTeam();
  }
}
