import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';


const routes: Routes = [
      // { path: 'welcome', component: WelcomeComponent },
      // { path: '', redirectTo: 'welcome', pathMatch: 'full' },
      // { path: '**', redirectTo: 'welcome', pathMatch: 'full' } 
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
