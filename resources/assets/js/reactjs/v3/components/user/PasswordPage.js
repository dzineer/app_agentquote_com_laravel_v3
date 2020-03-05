import React, {Component} from 'react';
import PropTypes from 'prop-types';
import PasswordForm from './PasswordForm';

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

                <PasswordForm  errors={this.state.errors} />
            </div>
        );
    }
}

UserPage.propTypes = {

};

export default UserPage;