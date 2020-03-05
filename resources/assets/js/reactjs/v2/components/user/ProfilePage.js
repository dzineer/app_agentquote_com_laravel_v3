import React, {Component} from 'react';
import PropTypes from 'prop-types';
import ProfileForm from './ProfileForm';

class ProfilePage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            errors: []
        };
    }

    render() {
        // // debugger;
        return (
            <div>
                <ProfileForm  errors={this.state.errors} />
            </div>
        );
    }
}

ProfilePage.propTypes = {

};

export default ProfilePage;