import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Login from './Auth/Login';
import Register from './Auth/Register';
import RememberPassword from './Auth/RememberPassword';

import { BrowserRouter as Router, Route } from "react-router-dom";

export default class Root extends Component {
  constructor(props){
    super(props);

  }
  render() {
    return (
      <Router>
        <div>
          <Route path="/" exact component={Login} />
          <Route path="/register" component={Register} />
          <Route path="/remember" component={RememberPassword} />
        </div>
      </Router>
    );
  }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Root />, document.getElementById('root'));
}
