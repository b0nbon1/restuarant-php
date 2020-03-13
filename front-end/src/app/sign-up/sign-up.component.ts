import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl } from '@angular/forms';

import { User } from './signup';



@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.scss']
})
export class SignUpComponent implements OnInit {
  signupForm: FormGroup;
  user = new User();


  constructor() { }

  ngOnInit() {
    this.signupForm = new FormGroup({
    firstName: new FormControl,
    lastName: new FormControl,
    email: new FormControl,
    password: new FormControl,
    confirmPassword: new FormControl,
    phoneNumber: new FormControl,
    city: new FormControl,
    state: new FormControl,
    zip: new FormControl,
    });
  }

  save() {
    console.log(this.signupForm);
    console.log('Saved: ' + JSON.stringify(this.signupForm.value));

  }

}
