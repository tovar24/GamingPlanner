import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { AuthRoutingModule } from './auth-routing.module';

// COMPONENTES
import { LoginPageComponent } from './pages/login-page/login-page.component';


@NgModule({
  imports: [
    CommonModule,
    AuthRoutingModule
  ],
  exports: [],
  declarations: [
    LoginPageComponent,
  ],
})
export class AuthModule { }
