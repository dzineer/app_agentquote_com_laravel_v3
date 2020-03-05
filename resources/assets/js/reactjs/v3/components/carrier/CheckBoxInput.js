import React from 'react';
import PropTypes from 'prop-types';
import toastr from "toastr";

/** Radio button  */
const CheckBoxInput = ({name, label, onChange}) => {
    let classNames = {
        wrapperClass: '',
        alert: 'alert alert-danger',
    };

    let css = {
        for: {
            container: {
                marginBottom: '16px'
            },
            input: {
                border: 'solid 1px red'
            },
            error: {
                color: 'red'
            },
            checkbox: {
                marginRight: '10px'
            }

        }
    };

    classNames.wrapperClass = error && error.length > 0 ? 'form-group has-error' : 'form-group';

    return (
        <div className="form-check">
            <label className="form-check-label" htmlFor={name}>
                <input className="form-check-input" type="checkbox" style={css.for.checkbox} onChange={onChange} />
                {label}
            </label>
        </div>
    );
};

CheckBoxInput.propTypes = {
    /** Input name. Recommend setting this to match object's property so a single change handler can */
    name: PropTypes.string.isRequired,

    /** Input name. Recommend setting this to match object's property so a single change handler can */
    label: PropTypes.string.isRequired,

    /** Function to call onChange */
    onChange: PropTypes.func.isRequired
/*
    /!** css styling *!/
    styles: PropTypes.string,

    /!** Value *!/
    value: PropTypes.string*/
};

CheckBoxInput.propTypes = {

};

export default CheckBoxInput;