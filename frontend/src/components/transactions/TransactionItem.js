import {useContext} from 'react';

import Card from '../ui/Card';
import classes from './TransactionItem.module.css';
import {titleCase} from "../ui/uiFunctions";
import UserDetailsContext from '../../store/userDetails-context';

function TransactionItem(props) {
    function deleteTransactionHandler(){

    }
    return (
        <li className={classes.item}>
            <Card>
                <div className={classes.content}>
                    <h3>Transaction ID : {props.id}</h3>
                    <h3>Title : {titleCase(props.title)}</h3>
                    <p>
                        Account ID : {props.account}<br/>
                        Type : {titleCase(props.type)}<br/>
                        Amount : {props.amount}<br/>
                        Time : {props.time}<br/>
                    </p>
                    <address>Description : {titleCase(props.description)}</address>
                    <p>Participants : {titleCase(props.participant)}</p>
                </div>
                <div className={classes.actions}>
                    <button className={classes.actions} onClick={deleteTransactionHandler}>
                        Delete
                    </button>
                </div>
            </Card>
        </li>
    );
}

export default TransactionItem;
