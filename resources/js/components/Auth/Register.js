import React, { Component } from 'react';
import { Link } from "react-router-dom";
import { validate } from "../../Libs/Validation";
import { Row, Col, Panel, FormGroup, ControlLabel, HelpBlock, FormControl, Button } from 'react-bootstrap';

export default class Login extends Component {
  constructor(props){
    super(props);
    this.state = {
      fullname: '',
      fullname_entered: false,
      email: '',
      email_entered: false,
      password: '',
      password_entered: false,

      can_accept: false,


      rules: {
        fullname: 'required',
        email: 'required|email',
        password: 'required|min:6'
      },
    };
  
    this.handleChange = (e, field) => {
      this.setState({
        [field]: e.target.value,
        [field + '_entered']: true,
      }, () => {
        this.setState({
          can_accept: 
            validate(this.state.rules.fullname, this.state.fullname) == 'success' && 
            validate(this.state.rules.email, this.state.email) == 'success' && 
            true,
        })
      });
    }

    this.submit = (e) => {
      if(this.state.can_accept)
        alert('accept!');
      else
        alert('validation error!');
    }
  }
  render() {
    return (
      <Panel>
        <Panel.Heading className="text-center">ورود</Panel.Heading>
        <Panel.Body>
          <FormGroup
            controlId="fullname"
            validationState={this.state.fullname_entered? validate(this.state.rules.fullname, this.state.fullname): null}
          >
            <ControlLabel>نام و نام خانوادگی</ControlLabel>
            <FormControl
              type="text"
              value={this.state.fullname}
              placeholder="عبید رحمانی"
              onChange={(e) => {this.handleChange(e, 'fullname')}}
            />
            <HelpBlock>نام خود را بنویسید. دیگران شما را با این نام می شناسند.</HelpBlock>
          </FormGroup>
          <FormGroup
            controlId="email"
            validationState={this.state.email_entered? validate(this.state.rules.email, this.state.email): null}
          >
            <ControlLabel>آدرس ایمیل</ControlLabel>
            <FormControl
              type="text"
              value={this.state.email}
              placeholder="abid@gmail.com"
              onChange={(e) => {this.handleChange(e, 'email')}}
            />
            <HelpBlock>آدرس ایمیل معتبر و یکتای خود را وارد کنید.</HelpBlock>
          </FormGroup>
          <FormGroup
            controlId="password"
            validationState={this.state.password_entered? validate(this.state.rules.password, this.state.password): null}
          >
            <ControlLabel>کلمه عبور</ControlLabel>
            <FormControl
              type="text"
              value={this.state.password}
              placeholder="johny"
              onChange={(e) => {this.handleChange(e, 'password')}}
            />
            <HelpBlock>کلمه عبور باید حداقل 6 کاراکتر و فقط حروف و اعداد لاتین باشد.</HelpBlock>
          </FormGroup>
          <Row>
            <Col className="text-center">
              <Button disabled={!this.state.can_accept} bsStyle="primary" onClick={this.submit} >ورود</Button>
            </Col>
          </Row>
        </Panel.Body>
      </Panel>
    );
  }
}