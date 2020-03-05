import React, { Component } from 'react';
import PropTypes from 'prop-types';
import ProgressBar from '../ProgressBar';
import EyeIcon from '../EyeIcon';
import TextInput from '../TextInput';

/** Password input with integrated label, quality tips, and show password toggle  */
class AdInput extends Component {
    constructor(props) {
        super(props);
        this.state = {
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

    render() {

        const {name, value, label, onChange, placeholder, ...props } = this.props;

        return (
            <div>
                { props.value }
            </div>
        );
    }
}

AdInput.propTypes = {
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

AdInput.defaultProps = {
    maxLength: 30,
    label: "Password"
};

export default AdInput;