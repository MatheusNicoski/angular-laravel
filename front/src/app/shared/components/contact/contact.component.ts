import { Component, OnInit } from '@angular/core';
import { Contact } from 'src/app/models/contact';
import { ContactService } from 'src/app/services/contact/contact.service';
import { TokenStorageService } from 'src/app/services/token-storage.service';

@Component({
  selector: 'app-home',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css'],
  providers: [ ContactService ]
})
export class ContactComponent implements OnInit {
  list?: any;
  errors = null;
  isSuccessful = false;
  msg = null;

  constructor(private contactService: ContactService, private tokenStorage: TokenStorageService) {
    this.contactService.getList().subscribe({
      next: data => {
        this.list = data;
      },
      error: err => {
        this.list = err.error.error;
      }
    });
  }

  ngOnInit(): void {
    if (!this.tokenStorage.getToken()) {
      window.location.href = "/login";
    }
  }

  delete(id: number): void {
    
    if (id) {
      this.contactService.delete(id).subscribe({
        next: data => {
          this.msg = data.msg;
          this.isSuccessful = true;
          this.reloadPage();
        },
  
        error: err => {        
          this.errors = err.error.error;
        }
      });
    }

  }

  reloadPage(): void {
    setTimeout(() => {
      window.location.reload();
    }, 2000); 
  }
}
