import {Route, Switch} from 'react-router-dom';

import LoginPage from './pages/Login';
import LogoutPage from './pages/Logout';

import AllAccountsPage from './pages/AllAccounts';
import NewAccountPage from './pages/NewAccount';

import AllTransactionsPage from './pages/AllTransactions';
import NewTransactionPage from './pages/NewTransaction';

import Layout from './components/layout/Layout';

function App() {
    return (
        <Layout>
            <Switch>
                <Route path='/' exact>
                    <LoginPage/>
                </Route>
                <Route path='/accounts'>
                    <AllAccountsPage/>
                </Route>
                <Route path='/new-account'>
                    <NewAccountPage/>
                </Route>
                <Route path='/transactions'>
                    <AllTransactionsPage/>
                </Route>
                <Route path='/new-transaction'>
                    <NewTransactionPage/>
                </Route>
                <Route path='/logout'>
                    <LogoutPage/>
                </Route>
            </Switch>
        </Layout>
    );
}

export default App;
