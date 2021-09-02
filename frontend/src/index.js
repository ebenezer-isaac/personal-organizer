import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from 'react-router-dom';

import './index.css';
import App from './App';
import {DetailsContextProvider} from "./store/userDetails-context";

ReactDOM.render(
  <DetailsContextProvider>
    <BrowserRouter>
      <App />
    </BrowserRouter>
  </DetailsContextProvider>,
  document.getElementById('root')
);
