import { Component, OnInit } from '@angular/core';
import { ProfileService } from './profile.service';
import { AuthService } from '../../auth/services/auth.service';
import { User } from '../../auth/interfaces/user.interface';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent implements OnInit {
  public user?: User;
  public userName: any;
  public userEmail: any;
  public userRol: any;
  public allUsers: any = [];
  public allRoles: any = [];
  public updateRol: boolean = false;
  public roleForm: FormGroup;
  private currentUserId = this.authService.currentUser?.id;

  constructor(
    private profileService: ProfileService,
    private authService: AuthService,
    private fb: FormBuilder
  ) {
    this.roleForm = this.fb.group({
      idUser: ['', Validators.required],
      idRol:  ['', Validators.required]
    });
  }

  getUser(id: any) {
    this.profileService.getUserById(id).subscribe(
      (response: any) => {
        this.user = response.map((item: any) => {
          this.userName = item.name;
          this.userEmail = item.email;
          this.userRol = item.idRol;
        });
      }
    );
  }

  getAllUsers() {
    this.profileService.getAllUsers().subscribe(
      (response: any) => {
        this.allUsers = response;
      }
    );
  }

  getAllRoles() {
    this.profileService.getAllRoles().subscribe(
      (response: any) => {
        this.allRoles = response.filter((item: any) => item.id !== 5);
      }
    );
  }

  enableRoles(item: boolean) {
    this.updateRol = item;
    this.roleForm.reset();
  }

  updateUserRol() {
    if (this.roleForm.invalid) {
      return;
    }
    const data = this.roleForm.value;

    this.profileService.updateUserRol(data).subscribe((response: any) => {
      this.getAllUsers();
      this.roleForm.reset();
    });
  }

  ngOnInit(): void {
    this.getUser(this.currentUserId);
    this.getAllUsers();
    this.getAllRoles();
  }

}
