import {createContext, useState} from 'react';

const UserDetailsContext = createContext({
    details: {id: "", name: "", accounts: [], availability: false},
    totalAccounts: 0,
    setDetails: (id, name, accounts) => {
    },
    addAccount: (id, title, description, balance) => {
    }
});

export function DetailsContextProvider(props) {
    const [userDetails, setUserDetails] = useState([]);

    function setDetailsHandler(id, name, accounts) {
        setUserDetails((details) => {
            details.id = id;
            details.name = name;
            details.accounts = accounts;
            details.availability = true;
            return details;
        });
        console.log("context has been set ", userDetails)
    }

    function addAccountHandler(id, title, balance, description) {
        userDetails.push({_id: id, title, balance, description})
    }

    function delAccountHandler(id) {
        userDetails.accounts.filter(account => account._id !== id)
    }

    const context = {
        details: userDetails,
        setDetails: setDetailsHandler,
        addAccount: addAccountHandler,
        delAccount: delAccountHandler
    };

    return (
        <UserDetailsContext.Provider value={context}>
            {props.children}
        </UserDetailsContext.Provider>
    );
}

export default UserDetailsContext;
