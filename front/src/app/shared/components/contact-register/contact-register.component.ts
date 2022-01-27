import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ContactService } from 'src/app/services/contact/contact.service';
import { TokenStorageService } from 'src/app/services/token-storage.service';

@Component({
  selector: 'app-contact-register',
  templateUrl: './contact-register.component.html',
  styleUrls: ['./contact-register.component.css']
})
export class ContactRegisterComponent implements OnInit {

  contact: any = {
    name: null,
    email: null,
    phone: null,
    cpf: null
  };

  errors = {
    name: null,
    email: null,
    phone: null,
    cpf: null
  };

  isSuccessful = false;
  msg = null;
  id?: number;

  constructor(private contactService: ContactService, private route: ActivatedRoute, private tokenStorage: TokenStorageService) {
  }

  public mask = {
    phone: ['(', /[0-9]/, /\d/, ')', ' ', /\d/, /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/],
    cpf: [/[0-9]/, /\d/, /\d/, '.' , /\d/, /\d/, /\d/, '.' , /\d/, /\d/, /\d/, '-', /\d/, /\d/]
  };

  ngOnInit(): void {
    
    if (!this.tokenStorage.getToken()) {
      window.location.href = "/login";
    }

    const id = Number(this.route.snapshot.paramMap.get('id'));

    if (id) {
      this.id = id;
      this.contactService.show(id).subscribe({
        next: data => {
          this.contact = data.data;
          this.msg = data.msg;
        },
  
        error: err => {        
          this.errors = err.error.error;
        }
      });
    }
  }

  onSubmit(): void {

    if (this.id) {
      this.contactService.update(this.id, this.contact).subscribe({
        next: data => {
          this.contact = data.data;
          this.msg = data.msg;
          this.isSuccessful = true;
          this.reloadPage();
        },
  
        error: err => {        
          this.errors = err.error.error;
        }
      });

    } else {

      this.contactService.create(this.contact).subscribe({
        next: data => {
          this.contact = data.data;
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
