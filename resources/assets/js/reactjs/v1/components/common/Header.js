import React from "react";
import { NavLink } from "react-router-dom";
import LoadingDots from "./LoadingDots";
import PropTypes from 'prop-types';

const Header = ({loading}) => {
    return (
            <nav className="navbar navbar-expand-lg navbar-light bg-light">
                <a className="navbar-brand" href="/">Navbar</a>
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <NavLink to="/" >Home</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/account" >My Account</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/courses" >Courses</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/user" >User</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/password" >Password</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/profile" >Profile</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/carriers" >Carriers</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/microsite" >Microsite</NavLink>
                    </li>
                    <li className="nav-item">
                        <NavLink to="/banner" >Banner</NavLink>
                    </li>

                </ul>
            { loading && <LoadingDots interval={100} dots={20} /> }
            </nav>

    )
};

Header.propTypes = {
    loading: PropTypes.bool.isRequired
};

export default Header;
