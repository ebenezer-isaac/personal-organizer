import { useHistory } from 'react-router-dom';

import NewAccountForm from '../components/accounts/NewAccountForm';
import {useContext} from "react";
import UserDetailsContext from "../store/userDetails-context";

function NewAccountPage() {
  const history = useHistory();
    const details = useContext(UserDetailsContext);
  function addAccountHandler(inputData) {
    fetch(
            'http://localhost:8080/addAccount',
            {
                method: 'POST',
                body: JSON.stringify(inputData),
                headers: {
                    'Content-Type': 'application/json',
                },
            }
        ).then(response => {
            return response.json()
        }).then(data=>{
            console.log(data)
            details.addAccount(data.id, inputData.title, inputData.balance, inputData.description)
            history.replace('/accounts');
        });
  }

  return (
    <section>
      <h1>Add New Account</h1>
      <NewAccountForm onAddAccount={addAccountHandler} />
    </section>
  );
}

export default NewAccountPage;
