import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { TokenStorageService } from 'src/app/services/token-storage.service';
import { UserService } from 'src/app/services/user/user.service';

@Component({
  selector: 'app-board-user',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  user: any = {
    name: null,
    email: null,
    password: null
  };

  errors = {
    name: null,
    email: null,
    password: null
  };

  isSuccessful = false;
  msg = null;

  constructor(private authService: AuthService, private userService: UserService, private tokenStorage: TokenStorageService) { }

  ngOnInit(): void {

    if (!this.tokenStorage.getToken()) {
      window.location.href = "/login";
    }

    this.userService.getUser().subscribe({
      next: data => {
        this.user = data;
      },
      error: err => {
        this.user = err.error.message;
      }
    });
  }

  onSubmit(): void {
    const { name, email, password } = this.user;

    this.authService.update(name, email, password).subscribe({
      next: data => {
        this.user = data.data;
        this.msg = data.msg;
        this.isSuccessful = true;
        this.reloadPage();
      },

      error: err => {        
        this.errors = err.error.error;
      }
    });
  }

  reloadPage(): void {
    setTimeout(() => {
      window.location.reload();
    }, 2000); 
  }
}
