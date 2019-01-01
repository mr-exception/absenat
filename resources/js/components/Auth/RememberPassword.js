import React, { Component } from 'react';
import { Link } from "react-router-dom";

export default class RememberPassword extends Component {
  constructor(props){
    super(props);
  }
  render() {
    return (
      <div>
        <p className="h4 mb-4 text-center">بازیابی کلمه عبور</p>
        <input type="email" id="email" className="form-control mb-4" placeholder="آدرس ایمیل" />
        <button className="btn btn-info btn-block my-4" type="button" >ارسال ایمیل بازیابی</button>
        <p className="text-center">
          <Link to="/"> بازگشت</Link>
        </p>
      </div>
    );
  }
}