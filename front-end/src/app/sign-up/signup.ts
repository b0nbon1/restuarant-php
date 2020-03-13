export class User {

  constructor(
    public firstName = '',
    public lastName = '',
    public email = '',
    public password = '',
    public confirmPassword = '',
    public phoneNumber = '',
    public city?: string,
    public state = '',
    public zip?: string
    ) { }
}
