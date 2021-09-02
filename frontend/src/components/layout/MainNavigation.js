import {useContext, useState} from 'react';
import {Link} from 'react-router-dom';

import classes from './MainNavigation.module.css';
import UserDetailsContext from '../../store/userDetails-context';

function MainNavigation() {
    const details = useContext(UserDetailsContext);
    const totalAccounts = details.details.availability?details.details.accounts.length:0;
    return (
        <header className={classes.header}>
            <div className={classes.logo}>Expensor</div>
            <nav>
                <ul>
                    <li>
                        <Link to='/new-account'>New Account</Link>
                    </li>
                    <li>
                        <Link to='/new-transaction'>New Transaction</Link>
                    </li>
                    <li>
                        <Link to='/transactions'>Transactions</Link>
                    </li>
                    <li>
                        <Link to='/accounts'>
                            Accounts
                            <span className={classes.badge}>
                                {totalAccounts}
                            </span>
                        </Link>
                    </li>
                </ul>
            </nav>
        </header>
    );
}

export default MainNavigation;
