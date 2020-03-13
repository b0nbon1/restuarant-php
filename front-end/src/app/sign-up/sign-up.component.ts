import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, FormBuilder, Validators, ValidatorFn, AbstractControl } from '@angular/forms';
import { debounceTime } from 'rxjs/operators';

// function passwordValidator (password: string): ValidatorFn {
//     return (c: AbstractControl): { [key: string]: boolean } | null => {
//       if (c.value === password) {
//         return { 'confirm': true }
//       }
//       return null;
//     }
// }

function passwordMatcher (c: AbstractControl): { [key: string]: boolean } | null {
  const passwordControl = c.get('password');
  const confirmPasswordControl = c.get('confirmPassword');
  if (passwordControl.pristine || confirmPasswordControl.pristine){
    return null
  }

  if (passwordControl.value === confirmPasswordControl.value) {
    return null;
  }
  return { 'match': true }
};


@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.scss'],
})
export class SignUpComponent implements OnInit {
  signupForm: FormGroup;
  isSubmitted: boolean = false;

  constructor(private fb: FormBuilder) { }

  ngOnInit() {

    this.signupForm = this.fb.group({
      firstName: ['', [Validators.required, Validators.minLength(3)]],
      lastName: ['', [Validators.required, Validators.minLength(3), Validators.maxLength(50)]],
      email: ['', [Validators.required, Validators.email]],
      passwordGroup: this.fb.group({
        password: ['', [Validators.required, Validators.minLength(6)]],
        confirmPassword: ['', [Validators.required]],
      }, { validator: passwordMatcher }),
      phoneNumber: ['', [Validators.required, Validators.minLength(6)]],
      city: ['', [Validators.required, Validators.minLength(2)]],
      state: '',
      zip: '',
    })

  }

  save() {
    this.isSubmitted = true;
    console.log(this.signupForm);
    console.log('Saved: ' + JSON.stringify(this.signupForm.value));
  }

}
