import React, { Component } from 'react';
import { Grid} from 'react-bootstrap';

import Search from './Component/Search';
import Fetching from './Component/Fetching';

import { fetchUser } from './Libs/Fetch';
class App extends Component {
  state = {
    query: '',
    step: 0,
    log: '',
    progress: 0,
    posts_count: 0,
  }
  finished = (results) => {

  }
  failed = () => {

  }
  search = () => {
    this.setState({
      step: 1,
    }, () => {
      fetchUser(this.state.query, this.finished, this.failed, this.setState);
    });
  }
  render() {
    return (
      <Grid>
        {this.state.step == 0? <Search search={this.search} /> : ''}
        {this.state.step == 1? <Fetching log={this.state.log} progress={this.state.progress} /> : ''}
      </Grid>
    );
  }
}

export default App;
