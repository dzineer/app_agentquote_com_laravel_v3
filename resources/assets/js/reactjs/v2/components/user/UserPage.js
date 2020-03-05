import React, {Component} from 'react';
import PropTypes from 'prop-types';
import UserForm from './UserForm';
import {NavLink} from "react-router-dom";
import LoadingDots from "../common/LoadingDots";

class UserPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            errors: []
        };
    }

    render() {
        // // debugger;
        const { courses } = this.props;
        return (
            <div>

                <br /><br />

               [ <a href="/profile" >Profile</a> | <a href="/password" >Change Password</a> ]

                <br /><br />

                <UserForm  errors={this.state.errors} />
            </div>
        );
    }
}

UserPage.propTypes = {

};

export default UserPage;