import React, { useState } from "react";
import img1 from "./image.jpeg";
import "./body.css";
import { SelectedCoursesProvider } from "./SelectedCoursesContext";
import Courses from "./Courses";
import Cart from "./Cart";

const Body = () => {
  const [currentRoute, setCurrentRoute] = useState("/");

  const renderComponent = () => {
    switch (currentRoute) {
      case "/courses":
        return <Courses />;
      case "/cart":
        return <Cart />;
      default:
        return <Courses />;
    }
  };

  return (
    <SelectedCoursesProvider>
      <div>
        {renderComponent()}
      </div>
    </SelectedCoursesProvider>
  );
};

export default Body;
