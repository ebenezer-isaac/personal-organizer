import {useState, useEffect, useContext} from 'react';
import UserDetailsContext from "../store/userDetails-context";
import TransactionList from "../components/transactions/TransactionList";

function AllTransactionsPage() {
    const details = useContext(UserDetailsContext);
    const [isLoading, setIsLoading] = useState(true);
    const [loadedTransactions, setLoadedTransactions] = useState([]);

    useEffect(() => {
        setIsLoading(true);
        let accounts=[];
        details.details.accounts.map((account)=>{
            accounts.push(account._id)
        })
        console.log("accounts in the  transactions", accounts)
        fetch(
            'http://localhost:8080/getAllTransactions', {
                method: 'POST',
                body: JSON.stringify({accounts}),
                headers: {
                    'Content-Type': 'application/json',
                }
            }
        )
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                const transactions = [];
                console.log()
                for (const key in data) {
                    const transaction = {
                        id: key,
                        ...data[key]
                    };
                    transactions.push(transaction);
                }

                setIsLoading(false);
                setLoadedTransactions(transactions);
            });
    }, []);

    if (isLoading) {
        return (
            <section>
                <p>Loading...</p>
            </section>
        );
    }

    return (
        <section>
            <h1>All Transactions</h1>
            <TransactionList transactions={loadedTransactions}/>
        </section>
    );
}

export default AllTransactionsPage;
