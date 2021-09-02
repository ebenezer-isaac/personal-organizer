import AccountItem from './AccountItem';
import classes from './AccountList.module.css';
import {Link} from "react-router-dom";

function AccountList(props) {
    function addAccountHandler(){

    }
    return (<div>
            <ul className={classes.list}>
                {props.accounts.map((account) => (
                    <AccountItem
                        key={account._id}
                        name={account.name}
                        balance={account.balance}
                        description={account.description}
                    />
                ))}
            </ul>
        </div>
    );
}

export default AccountList;
