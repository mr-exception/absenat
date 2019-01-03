import React, { Component } from 'react';
import { Grid, Row, Col, FormGroup, FormControl, Button, ProgressBar } from 'react-bootstrap';

class Fetching extends Component {
  render() {
    return (
      <div>
        <Row style={{marginTop: 200}}>
          <Col md={8} xs={10} mdOffset={2} xsOffset={1}>
            <ProgressBar now={this.props.progress} label={`${this.props.progress}%`} active />
          </Col>
        </Row>
        <Row>
          <Col className="text-center" md={8} xs={10} mdOffset={2} xsOffset={1}>
            {this.props.log}
          </Col>
        </Row>
      </div>
    );
  }
}

export default Fetching;
