import React, {Component} from 'react';
import PropTypes from 'prop-types';
import TextInput from '../TextInput';
import PasswordInput from '../PasswordInput';

/** RegistrationFormContainer form with built-in validation */
class RegistrationFormContainer extends Component {
    constructor(props) {
        super(props);
        this.state = {
            user: {
                email:'',
                password:''
            },
            errors: [],
            submitted: false
        };
    }

    onChange = (event) => {
        const user = Object.assign({}, this.state.user);
        user[event.target.name] = event.target.value;
        this.setState({user});
    };

    // Returns a number from 0 to 100 that represents password quality.
    // For simplicity, just returning % of min length entered.
    // Could enhance with checks for number, special char, unique characters, etc.
    passwordQuality(password) {
        if (!password) return null;
        if (password.length >= this.props.minPasswordLength) return 100;
        const percentOfLength = parseInt(password.length/this.props.minPasswordLength * 100, 10);
        return percentOfLength;
    }

    validate({email, password}) {
        const errors = {};
        const {minPasswordLength} = this.props;

        if (!email) errors.email = 'Email required.';
        if (password.length < minPasswordLength) errors.password = `Password must be at least ${minPasswordLength} characters.`;

        this.setState({errors});
        const formIsValid = Object.getOwnPropertyNames(errors).length === 0;
        return formIsValid;
    }

    onSubmit = event => {
        const {user} = this.state;
        const isFormValid = this.validate(user);
        if (isFormValid) {
            this.props.onSubmit(user);
            this.setState({submitted: true})
        }
    }

    render() {
        const {errors, submitted} = this.state;
        const {email, password} = this.state.user;

        return (
            submitted ?
                <h2>{this.props.confirmationMessage}</h2> :
                <form>
                    <TextInput
                        htmlId="registration-form-email"
                        name="email"
                        onChange={this.onChange}
                        label="Email"
                        value={email}
                        error={errors.email}
                        required
                    />

                    <PasswordInput
                        htmlId="registration-form-password"
                        name="password"
                        onChange={this.onChange}
                        value={password}
                        quality={this.passwordQuality(password)}
                        showVisibilityToggle
                        maxLength={50}
                        error={errors.password}
                    />

                    <input type="submit" value="Register" onClick={this.onSubmit} />
                </form>
        );
    }
}

RegistrationFormContainer.propTypes = {
    /** Message display upon successful submission */
    confirmationMessage: PropTypes.string.isRequired,

    /** Called when form is submitted */
    onSubmit: PropTypes.func.isRequired,

    /** Minimum password length */
    minPasswordLength: PropTypes.number
};

RegistrationFormContainer.defaultProps = {
    confirmationMessage: "Thanks for registering!",
    minPasswordLength: 8
};

export default RegistrationFormContainer;
