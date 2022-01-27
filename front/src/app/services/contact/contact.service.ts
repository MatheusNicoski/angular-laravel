import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Contact } from 'src/app/models/contact';

const API_URL = 'http://127.0.0.1:8000/api/v1/contact/';

@Injectable({
  providedIn: 'root'
})
export class ContactService {
  constructor(private http: HttpClient) { }

  getList(): Observable<any> {
    return this.http.get(API_URL + 'list');
  }

  show(id: number): Observable<any> {
    return this.http.get<any>(API_URL + 'show/' + id);
  }

  create(contact: Contact): Observable<any> {
    return this.http.post<any>(API_URL + 'register', contact);
  }

  
  update(id: number, contact: Contact): Observable<any> {
    return this.http.put<any>(API_URL + 'update/' + id, contact);
  }

  delete(id: number): Observable<any> {
    return this.http.delete<any>(API_URL + 'delete/' + id);
  }
}
