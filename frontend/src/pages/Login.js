import {useContext} from 'react';

import UserDetailsContext from '../store/userDetails-context';
import {useHistory} from 'react-router-dom';
import LoginForm from "../components/login/LoginForm";

function LoginPage() {
    const details = useContext(UserDetailsContext);
    const history = useHistory();

    function loginHandler(inputData) {
        fetch(
            'http://localhost:8080/login',
            {
                method: 'POST',
                body: JSON.stringify(inputData),
                headers: {
                    'Content-Type': 'application/json',
                },
            }
        ).then(response => {
            return response.json()
        }).then(data=>{
            console.log(data)
            details.setDetails(data.id, data.name, data.accounts)
            history.replace('/accounts');
        });
    }

    let content;
    console.log(details)
    if (!details.availability) {
        content = <LoginForm onLogin={loginHandler}/>;
    } else {
        history.replace('/');
    }

    return (
        <section>
            <h1>Login</h1>
            {content}
        </section>
    );
}

export default LoginPage;
