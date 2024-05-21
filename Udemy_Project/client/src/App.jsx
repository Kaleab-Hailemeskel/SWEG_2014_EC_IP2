import React, { useState } from "react";
import "./App.css";
import ReactDOM from 'react-dom'
import Header from "./components/header/Header";
import Body from "./components/body/Body";
import Footer from "./components/footer/Footer";

function App() {
  const [category, setCategory] = useState(() => ({
    currentCategory: "ug",
  }));
  const [links, setLinks] = useState(() => ({
    cart: "off",
    aboutUs: "off",
    Terms: "off",
    cookieSettings: "off",
    contact: "off",
    teachOnUdemy: "off",
    privacyPolicy: "off",
    signUp: "off",
    login: "off",
  }));
  const [loginStatus, setLoginStatus] = useState(() => ({
    login: "false",
  }));
  return (
    <div className="App">
      <Header
        category={category}
        setCategory={setCategory}
        links={links}
        setLinks={setLinks}
        loginStatus={loginStatus}
        setLoginStatus={setLoginStatus}
      />
      <Body
        category={category}
        setCategory={setCategory}
        links={links}
        setLinks={setLinks}
        loginStatus={loginStatus}
        setLoginStatus={setLoginStatus}
      />
      <Footer links={links} setLinks={setLinks} />
    </div>
  );
}

export default App;
