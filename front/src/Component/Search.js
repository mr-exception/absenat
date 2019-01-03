import React, { Component } from 'react';
import { Grid, Row, Col, FormGroup, FormControl, Button, ProgressBar } from 'react-bootstrap';

class Search extends Component {
  state = {
    query: '',
  }
  queryChanged = (e) => {
    const query = e.target.value;
    this.setState({
      query
    });
  }
  render() {
    return (
      <div>
        <Row style={{marginTop: 200}}>
          <Col md={8} xs={10} mdOffset={2} xsOffset={1}>
            <FormGroup bsSize="large">
              <FormControl type="text" onChange={this.queryChanged} placeholder="Username or Link" />
            </FormGroup>
          </Col>
        </Row>
        <Row>
          <Col className="text-center" md={8} xs={10} mdOffset={2} xsOffset={1}>
            <Button className="btn-primary" onClick={() => {this.props.search(this.state.query)}} bsSize="large">Start!</Button>
          </Col>
        </Row>
      </div>
    );
  }
}
export default Search;