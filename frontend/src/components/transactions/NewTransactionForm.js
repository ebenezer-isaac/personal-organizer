import {useContext, useRef} from 'react';

import Card from '../ui/Card';
import classes from './NewTransactionForm.module.css';
import UserDetailsContext from "../../store/userDetails-context";

function NewTransactionForm(props) {
    const details = useContext(UserDetailsContext);
    const accountInputRef = useRef();
    const titleInputRef = useRef();
    const typeInputRef = useRef();
    const participantInputRef = useRef();
    const amountInputRef = useRef();
    const descriptionInputRef = useRef();
    const timeInputRef = useRef();

    function submitHandler(event) {
        event.preventDefault();
        const enteredAccount = accountInputRef.current.value;
        const enteredTitle = titleInputRef.current.value;
        const enteredType = typeInputRef.current.value;
        const enteredParticipant = participantInputRef.current.value;
        const enteredAmount = amountInputRef.current.value;
        const enteredDescription = descriptionInputRef.current.value;
        const enteredTime = timeInputRef.current.value;


        const inputData = {
            account: enteredAccount,
            title: enteredTitle,
            type: enteredType,
            participant: enteredParticipant,
            amount: enteredAmount,
            description: enteredDescription,
            time: enteredTime
        };

        props.onAddTransaction(inputData);
    }

    return (
        <Card>
            <form className={classes.form} onSubmit={submitHandler}>
                <div className={classes.control}>
                    <label htmlFor='title'>Transaction Account</label>
                    <select ref={accountInputRef}>
                        {details.details.accounts.map(account => (
                            <option value={account._id}>{account.name}</option>
                        ))}
                    </select>
                </div>
                <div className={classes.control}>
                    <label htmlFor='title'>Transaction Title</label>
                    <input type='text' required id='title' ref={titleInputRef}/>
                </div>
                <div className={classes.control}>
                    <label htmlFor='type'>Transaction Type</label>
                    <input type='text' required id='type' ref={typeInputRef}/>
                </div>
                <div className={classes.control}>
                    <label htmlFor='participant'>Participants</label>
                    <input type='text' required id='participant' ref={participantInputRef}/>
                </div>
                <div className={classes.control}>
                    <label htmlFor='amount'>Amount</label>
                    <input type='text' required id='amount' ref={amountInputRef}/>
                </div>
                <div className={classes.control}>
                    <label htmlFor='description'>Description</label>
                    <textarea
                        id='description'
                        required
                        rows='5'
                        ref={descriptionInputRef}/>
                </div>
                <div className={classes.control}>
                    <label htmlFor='time'>Time</label>
                    <input type='text' required id='time' ref={timeInputRef}/>
                </div>
                <div className={classes.actions}>
                    <button>Add Transaction</button>
                </div>
            </form>
        </Card>
    );
}

export default NewTransactionForm;
