import "./header.css";
import React from "react";
import udemyLogo from "./img/udemy-logo.png";
import cart from "./img/cart.png";

const Header = () => {
  return (
    <nav className="navbar navbar-expand-sm navbar-light bg-light">
      <div className="navbar-container container-fluid gap-3 gap-lg-5 ">
        <img
          className="navbar-brand udemy-logo"
          src={udemyLogo}
          alt="Udemy Logo"
        />
        <button
          className="navbar-toggler"
          data-bs-toggle="collapse"
          data-bs-target="#nav"
          aria-label="Expand Navigation"
          aria-controls="nav">
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="nav">
          <ul className="navbar-nav gap-sm-2 gap-lg-4">
            <li className="nav-item">
              <select name="category-selector" id="category" className="nav-link header-selector">
                <option value="under-graduate">Under Graduate</option>
                <option value="post-graduate">Post Graduate</option>
                <option value="phd-program">PHD Program</option>
                <option value="extra-curricular">Extra Curricular</option>
              </select>
            </li>
            <li className="nav-item">
              <input
                className="rounded-pill border-0 form-control "
                id="search-bar"
                type="text"
                placeholder="Search for anything"
              />
            </li>
            <li className="nav-item">
              <a href="#" className="btn btn-sm ">
                <img src={cart} class="cart" alt="cart" />
              </a>
            </li>
            <li className="nav-item">
              <a href="#" className="btn btn-sm   btn-outline-dark">
                Login
              </a>
            </li>
            <li className="nav-item">
              <a href="#" className="btn btn-sm btn-dark">
                Sign up
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  );
};

export default Header;
