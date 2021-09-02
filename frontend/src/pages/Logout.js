import {useContext} from 'react';

import UserDetailsContext from '../store/userDetails-context';
import AccountsList from '../components/accounts/AccountList';
import classes from "../components/layout/MainNavigation.module.css";
import {Link} from "react-router-dom";

function LogoutPage() {
    const details = useContext(UserDetailsContext);

    let content;

    if (details.availability) {
        content = <div>
            <p>You need to be logged in to see your accounts</p>
            <Link to='/'>
                My Favorites
                <span className={classes.badge}>
                {details.totalAccounts}
              </span>
            </Link>
        </div>;
    }

    return (
        <section>
            <h1>My Favorites</h1>
            {content}
        </section>
    );
}

export default LogoutPage;
