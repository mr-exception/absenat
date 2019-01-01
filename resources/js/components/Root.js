import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import AuthMain from './Auth/Main';

import { BrowserRouter as Router, Route } from "react-router-dom";

export default class Root extends Component {
  constructor(props){
    super(props);
  }
  render() {
    return (
      <Router>
        <AuthMain />
      </Router>
    );
  }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Root />, document.getElementById('root'));
}
