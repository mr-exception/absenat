import React, { Component } from 'react';
import './App.css';
import { Grid, Row, Col, FormGroup, FormControl, Button, ProgressBar } from 'react-bootstrap';

class App extends Component {
  state = {
    query: '',
    step: 0,
    log: '',
    progress_precentage: 0,
    posts_count: 0,
  }
  queryChanged = (e) => {
    const query = e.target.value;
    this.setState({
      query
    });
  }
  start = (e) => {
    this.setState({
      step: 1,
      log: 'fetch user profile.',
      progress_precentage: 10,
    }, () => {
      setTimeout(() => {
        this.fetchUser();
      }, 2000)
    });
  }

  fetchUser = () => {
    this.setState({
      step: 2,
      log: 'get posts count.',
      progress_precentage: 15,
    }, () => {
      setTimeout(() => {
        this.fetchPostsCount();
      }, 1000);
    });
  }

  fetchPostsCount = () => {
    const posts_count = parseInt((Math.random() * 1000) + 250);
    this.setState({
      step: 3,
      log: `get posts (0/${posts_count})`,
      progress_precentage: 20,
      posts_count,
      fetched_posts: 0,
    }, () => {
      setTimeout(() => {
        this.fetchPost();
      }, parseInt(Math.random()*200 +50));
    })
  }

  fetchPost = () => {
    this.setState({
      fetched_posts: this.state.fetched_posts +1,
      log: `get posts (${this.state.fetched_posts+1}/${this.state.posts_count})`,
    }, () => {
      if(this.state.fetched_posts < this.state.posts_count){
        setTimeout(() => {
          this.fetchPost();
        }, parseInt(Math.random()*200 +50));
      }
    })
  }
  render() {
    return (
      <Grid>
        {!this.state.step?
          [<Row style={{marginTop: 200}}>
            <Col md={8} xs={10} mdOffset={2} xsOffset={1}>
              <FormGroup bsSize="large">
                <FormControl type="text" onChange={this.queryChanged} placeholder="Username or Link" />
              </FormGroup>
            </Col>
          </Row>,
          <Row>
            <Col className="text-center" md={8} xs={10} mdOffset={2} xsOffset={1}>
              <Button className="btn-primary" onClick={this.start} bsSize="large">Start!</Button>
            </Col>
          </Row>]
          :
          [
            <Row style={{marginTop: 200}}>
              <Col md={8} xs={10} mdOffset={2} xsOffset={1}>
                <ProgressBar now={this.state.progress_precentage} label={`${this.state.progress_precentage}%`} active />
              </Col>
            </Row>
            ,
            <Row>
              <Col className="text-center" md={8} xs={10} mdOffset={2} xsOffset={1}>
                {this.state.log}
              </Col>
            </Row>
          ]
        }
      </Grid>
    );
  }
}

export default App;
