import {useHistory} from 'react-router-dom';

import NewTransactionForm from "../components/transactions/NewTransactionForm";

function NewTransactionPage() {
    const history = useHistory();

    function addTransactionHandler(inputData) {
        fetch(
            'http://localhost:8080/newTransaction',
            {
                method: 'POST',
                body: JSON.stringify(inputData),
                headers: {
                    'Content-Type': 'application/json',
                },
            }
        ).then(data => {
            console.log(data)
            //history.replace('/');
        }).catch(err => console.log(err));
    }

    return (
        <section>
            <h1>Add Transaction</h1>
            <NewTransactionForm onAddTransaction={addTransactionHandler}/>
        </section>
    );
}

export default NewTransactionPage;
