import React from 'react';
import PropTypes from 'prop-types';
import Label from '../Label';

/** Text input with integrated label to enforce consistency in layout, error display, label placement  */
const TextArea = ({
        name,
        label,
        placeholder,
        onChange,
        value,
        required,
        error,
        styles,
        className,
        ...props
    }) => {

    let classNames = {
        wrapperClass: 'form-group',
        alert: 'alert alert-danger',
    };

    let css = {
        for: {
            container: {
                marginBottom: '16px'
            },
            textArea: {
                height: '100px !important'
            },
            error: {
                color: 'red'
            }
        }
    };

    console.log(
        "[many props]",
        { name:name,
        label: label,
        placeholder: placeholder,
        onChange: onChange,
        value: value,
        required: required,
        error: error,
        styles: styles }
    );

    return (
        <div className={classNames.wrapperClass} style={styles}>
            <Label htmlFor={name} label={label} required={required} styles={styles.for.field.spacing} className={className} />
            <div className="field">
                <textarea
                    id={name}
                    className="form-control"
                    name={name}
                    onChange={onChange}
                    placeholder={placeholder}
                    required={required}
                    style={{height: '100px !important'}}
                >
                    {value}
                </textarea>
            </div>
        </div>
    );
};

TextArea.propTypes = {
    /** Input name. Unique HTML ID. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,

    /** Input label  */
    label: PropTypes.string.isRequired,

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
    children: PropTypes.node,

    /** Styles */
    styles: PropTypes.object,

    className: PropTypes.string
};

TextArea.defaultProps = {
    error: '',
    styles: {}
};

export default TextArea;
