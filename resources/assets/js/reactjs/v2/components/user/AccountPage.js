import React, {Component} from 'react';
import PropTypes from 'prop-types';
import ProfileForm from './ProfileForm';
import AccountInfo from "./AccountInfo";
import ContentForm from "../common/ContentForm";

class AccountPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            errors: []
        };
    }

    render() {
        // // debugger;
        return (
            <ContentForm>
                <AccountInfo />
            </ContentForm>
        );
    }
}

AccountPage.propTypes = {

};

export default AccountPage;