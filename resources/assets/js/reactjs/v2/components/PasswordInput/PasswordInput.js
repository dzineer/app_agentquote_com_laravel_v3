import React, { Component } from 'react';
import PropTypes from 'prop-types';
import ProgressBar from '../ProgressBar';
import EyeIcon from '../EyeIcon';
import TextInput from '../TextInput';

/** Password input with integrated label, quality tips, and show password toggle  */
class PasswordInput extends Component {
    constructor(props) {
        super(props);
        this.state = {
            showPassword: false
        };

        this.css = {
            for: {
                container: {
                    marginBottom: '16px'
                },
                input: {
                    border: 'solid 1px red'
                },
                error: {
                    color: 'red'
                }
            }
        };
    }
    /** this a class property that is not part of the official JS spec yet. But Babel will transpile it. */
    toggleShowPassword = event => {
        this.setState( prevState => {
            return { showPassword: !prevState.showPassword };
        });
        if (event) event.preventDefault();
    };

    render() {

        const {name, value, label, onChange, placeholder, ...props } = this.props;

        return (
            <div style={this.css.for.container}>
                <TextInput
                    id={name}
                    name={name}
                    label={label}
                    placeholder={placeholder}
                    value={value}
                    required={true}
                    type={"password"}
                    onChange={onChange}
                    {...props}>
                </TextInput>
            </div>
        );
    }
}

PasswordInput.propTypes = {
    /** Input name. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,

    /** Input label  */
    label: PropTypes.string.isRequired,

    /** Function to call onChange */
    onChange: PropTypes.func.isRequired,

    /** Placeholder to display when empty */
    placeholder: PropTypes.string,

    /** Maximum size of password field */
    maxLength: PropTypes.number,

    /** show visibility */
    showVisibilityToggle: PropTypes.bool,

    /** Quality  */
    quality: PropTypes.number,

    /** Value  */
    value: PropTypes.any,

    /** String to display when error occurs.  */
    error: PropTypes.string,
};

PasswordInput.defaultProps = {
    maxLength: 30,
    label: "Password"
};

export default PasswordInput;