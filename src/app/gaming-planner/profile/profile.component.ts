import { Component, OnInit } from '@angular/core';
import { ProfileService } from './profile.service';
import { AuthService } from '../../auth/services/auth.service';
import { User } from '../../auth/interfaces/user.interface';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrl: './profile.component.css'
})
export class ProfileComponent implements OnInit {
  public user?: User;

  constructor(
    private profileService: ProfileService,
    private authService: AuthService
  ) {}

  getUser(id: any) {
    this.profileService.getUserById(id).subscribe(
      (response: any) => {
        this.user = response;
      }
    );
  }

  ngOnInit(): void {
    this.getUser(this.authService.currentUser?.id);
  }

}
