import {useContext} from 'react';
import {titleCase} from "../ui/uiFunctions";
import Card from '../ui/Card';
import classes from './AccountItem.module.css';
import UserDetailsContext from '../../store/userDetails-context';
import {Link} from "react-router-dom";

function AccountItem(props) {

    function deleteAccountHandler() {
        //   if (itemIsFavorite) {
        //     favoritesCtx.removeFavorite(props.id);
        //   } else {
        //     favoritesCtx.addFavorite({
        //       id: props.id,
        //       title: props.title,
        //       description: props.description,
        //       image: props.image,
        //       address: props.address,
        //     });
        //   }
    }

    return (
        <li className={classes.item}>
            <Card>
                <div className={classes.content}>
                    <h3>Title : {titleCase(props.name)}</h3>
                    <address>Description : {titleCase(props.description)}</address>
                    <p>Balance : {props.balance}</p>
                </div>
                <div className={classes.actions}>
                    <button className={classes.actions} onClick={deleteAccountHandler}>
                        Delete
                    </button>
                </div>
            </Card>
        </li>
    );
}

export default AccountItem;
