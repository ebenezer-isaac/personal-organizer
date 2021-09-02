import {useContext, useState} from 'react';

import AccountList from '../components/accounts/AccountList';
import UserDetailsContext from "../store/userDetails-context";
import NewAccountForm from "../components/accounts/NewAccountForm";

function AllAccountsPage() {
    const details = useContext(UserDetailsContext);


    if (details.details.availability) {
        return (
            <section>
                <h1>All Accounts</h1>
                <AccountList accounts={details.details.accounts}/>
            </section>
        );
    }

    return (
        <section>
            <NewAccountForm/>
        </section>
    );
}

export default AllAccountsPage;
