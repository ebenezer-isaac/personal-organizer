import { useRef } from 'react';

import Card from '../ui/Card';
import classes from './LoginForm.module.css';

function LoginForm(props) {
  const emailInputRef = useRef();
  const passwordInputRef = useRef();

  function submitHandler(event) {
    event.preventDefault();

    const enteredEmail = emailInputRef.current.value;
    const enteredPassword = passwordInputRef.current.value;

    const inputData = {
      email: enteredEmail,
      password: enteredPassword,
    };

    props.onLogin(inputData);
  }

  return (
    <Card>
      <form className={classes.form} onSubmit={submitHandler}>
        <div className={classes.control}>
          <label htmlFor='title'>Username</label>
          <input type='text' required id='email' placeholder='Username' value='ebenezerv99@gmail.com' ref={emailInputRef} />
        </div>
        <div className={classes.control}>
          <label htmlFor='image'>Password</label>
          <input type='password' required id='password' placeholder='Password' value='asdf' ref={passwordInputRef} />
        </div>
        <div className={classes.actions}>
          <button>Login</button>
        </div>
      </form>
    </Card>
  );
}

export default LoginForm;
