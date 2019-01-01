import React, { Component } from 'react';
import { Route } from "react-router-dom";
import Login from './Login';
import Register from './Register';
import RememberPassword from './RememberPassword';
import { Grid, Row, Col } from 'react-bootstrap';

export default class Main extends Component {
  constructor(props){
    super(props);
  }
  render() {
    return (
      <Grid className="top-space">
        <Row>
          <Col md={6} xs={10} mdOffset={3} xsOffset={1}>
            <Route path="/" exact component={Login} />
            <Route path="/register" component={Register} />
            <Route path="/remember" component={RememberPassword} />
          </Col>
        </Row>
      </Grid>
    );
  }
}