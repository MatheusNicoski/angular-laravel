import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

const API_URL = 'http://127.0.0.1:8000/api/v1/user';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  constructor(private http: HttpClient) { }

  getContacts(): Observable<any> {
    return this.http.get(API_URL + 'contact/list');
  }

  getUsers(): Observable<any> {
    return this.http.get(API_URL + '/list');
  }

  getUser(): Observable<any> {
    return this.http.get(API_URL + '/profile');
  }

}
