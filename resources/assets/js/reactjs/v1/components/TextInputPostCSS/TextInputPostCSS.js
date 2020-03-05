import React from 'react';
import PropTypes from 'prop-types';
import Label from '../Label';
import styles from './textInput.css';

/** Text input with integrated label to enforce consistency in layout, error display, label placement  */
const TextInput = ({htmlId, name, label, type="text", required=false, placeholder, value, children, error, ...props}) => {
    const css = {
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

    return (
        <div style={css.for.container} className={styles.fieldset}>
            <Label htmlFor={htmlId} label={label} required={required} />
            <input
                id={htmlId}
                type={type}
                name={name}
                placeholder={placeholder}
                value={value}
                className={error && styles.inputError}
                required
                {...props}
            />
            {children}
            {error && <div className={styles.error}>{error}</div>}
        </div>
    );
};

TextInput.propTypes = {
    /** Unique HTML ID. Used for tying label to HTML input. Handy hook for automated testing.  */
    htmlId: PropTypes.string.isRequired,
    /** Input name. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,

    /** Input label  */
    label: PropTypes.string.isRequired,

    /** Input type  */
    type: PropTypes.string.isRequired,

    /** Mark label with asterisk if set to true */
    required: PropTypes.bool,

    /** Function to call onChange */
    onChange: PropTypes.func.isRequired,

    /** Placeholder to display when empty */
    placeholder: PropTypes.string,

    /** Value  */
    value: PropTypes.any,

    /** String to display when error occurs.  */
    error: PropTypes.string,

    /** Child component to display next to input  */
    children: PropTypes.node
};

export default TextInput;