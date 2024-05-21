import React from "react";
import './footer.css'
import udemyLogo from "../header/img/udemy-logo.png";

const Footer = () => {
  return (
    <div className="container-fluid  footer-container ">
      <div className="row">
        <div className="col-3 col-md-3">
          <a href="#" className="btn">Teach on Udemy</a>
          <a href="#" className="btn">About us</a>
          <a href="#" className="btn">Contact us</a>
        </div>
        <div className="col-3 col-xs-2 col-md-4">
          <a href="#" className="btn">Terms</a>
          <a href="#" className="btn">Privacy policy</a>
          <a href="#" className="btn">Cookie Settings</a>
        </div>
        <div className="col-4 col-md-3"></div>
        <div className="col">
          <img class= "footer-udemy-logo "src={udemyLogo} alt="udemy-logo" />
        </div>
        </div>
      </div>
  );
};

export default Footer;
