import React, { Component } from 'react';
import { Link } from "react-router-dom";

export default class Login extends Component {
  constructor(props){
    super(props);
  }
  render() {
    return (
      <div>
        <p className="h3 text-center">ورود</p>
        <input type="email" id="email" className="form-control mb-4" placeholder="آدرس ایمیل" />
        <input type="password" id="password" className="form-control mb-4" placeholder="کلمه عبور" />
        <div className="d-flex justify-content-around">
          <div>
            <Link to="/remember">کلمه عبورم را فراموش کردم</Link>
          </div>
        </div>
        <button className="btn btn-info btn-block my-4" type="button" >ورود</button>
        <p className="text-center">
          عضو نیستم! <Link to="/register"> ثبت نام</Link>
        </p>
      </div>
    );
  }
}