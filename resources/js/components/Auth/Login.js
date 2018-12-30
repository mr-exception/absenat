import React, { Component } from 'react';
import { Link } from "react-router-dom";

export default class Login extends Component {
  constructor(props){
    super(props);
  }
  render() {
    return (
        <div className="container">
          <div className="row justify-content-center" style={{marginTop: '60px'}}>
            <div className="col-md-6 col-8">
                <form className="text-center border border-light p-5">
                    <p className="h4 mb-4">ورود</p>
                    <input type="email" id="email" className="form-control mb-4" placeholder="آدرس ایمیل" />
                    <input type="password" id="password" className="form-control mb-4" placeholder="کلمه عبور" />
                    <div className="d-flex justify-content-around">
                        <div>
                            <div className="custom-control custom-checkbox">
                            <input type="checkbox" className="custom-control-input" id="defaultLoginFormRemember" />
                            <label className="custom-control-label" for="defaultLoginFormRemember">مرا به خاطر بیاور</label>
                            </div>
                        </div>
                        <div>
                            <Link to="/remember">کلمه عبورم را فراموش کردم</Link>
                        </div>
                    </div>
                    <button className="btn btn-info btn-block my-4" type="button" >ورود</button>
                    <p>عضو نیستم!
                    <Link to="/register"> ثبت نام</Link>
                    </p>
                </form>
            </div>
          </div>
        </div>
    );
  }
}