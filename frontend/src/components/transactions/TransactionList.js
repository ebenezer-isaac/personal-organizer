import TransactionItem from './TransactionItem';
import classes from './TransactionList.module.css';

function TransactionList(props) {
  return (
    <ul className={classes.list}>
      {props.transactions.map((transaction) => (
        <TransactionItem
          key={transaction._id}
          id={transaction._id}
          account={transaction.account}
          title={transaction.title}
          type={transaction.type}
          participant={transaction.participant}
          amount={transaction.amount}
          description={transaction.description}
          time={transaction.time}
        />
      ))}
    </ul>
  );
}

export default TransactionList;
