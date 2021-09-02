import {useRef} from 'react';

import Card from '../ui/Card';
import classes from './NewAccountForm.module.css';

function NewAccountForm(props) {
    const titleInputRef = useRef();
    const balanceInputRef = useRef();
    const descriptionInputRef = useRef();

    function submitHandler(event) {
        event.preventDefault();

        const enteredTitle = titleInputRef.current.value;
        const enteredBalance = balanceInputRef.current.value;
        const enteredDescription = descriptionInputRef.current.value;

        const inputData = {
            title: enteredTitle,
            balance: enteredBalance,
            description: enteredDescription,
        };

        props.onAddAccount(inputData);
    }

    return (
        <Card>
            <form className={classes.form} onSubmit={submitHandler}>
                <div className={classes.control}>
                    <label htmlFor='title'>Account Title</label>
                    <input type='text' required id='title' ref={titleInputRef}/>
                </div>
                <div className={classes.control}>
                    <label htmlFor='balance'>Account Balance</label>
                    <input type='text' required id='balance' ref={balanceInputRef}/>
                </div>
                <div className={classes.control}>
                    <label htmlFor='description'>Account Description</label>
                    <textarea
                        id='description'
                        required
                        rows='5'
                        ref={descriptionInputRef}
                    />
                </div>
                <div className={classes.actions}>
                    <button>Add Account</button>
                </div>
            </form>
        </Card>
    );
}

export default NewAccountForm;
